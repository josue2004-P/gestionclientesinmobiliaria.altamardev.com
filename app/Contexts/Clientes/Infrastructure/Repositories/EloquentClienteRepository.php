<?php

namespace App\Contexts\Clientes\Infrastructure\Repositories;

use App\Contexts\Clientes\Domain\Entities\Cliente;
use App\Contexts\Clientes\Domain\Entities\ClienteTelefono;
use App\Contexts\Clientes\Domain\Entities\ClienteReferencia;
use App\Contexts\Clientes\Domain\Entities\ClienteDocumento;
use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;
use App\Contexts\Clientes\Infrastructure\LaravelModels\ClienteEloquentModel;
use Illuminate\Support\Facades\DB;
use DateTime;

class EloquentClienteRepository implements ClienteRepositoryInterface
{
    public function getAll(): array
    {
        return ClienteEloquentModel::all()->map(fn($m) => $this->toEntity($m))->toArray();
    }

    public function findById(int $id): ?Cliente
    {
        $modelo = ClienteEloquentModel::with(['zonasInteres', 'telefonos','referencias'])->find($id);
        if (!$modelo) return null;

        return $this->toEntity($modelo);
    }

    public function save(Cliente $cliente): int
    {
        return DB::transaction(function () use ($cliente) {
            $model = ClienteEloquentModel::updateOrCreate(
                ['id' => $cliente->getId()],
                $this->toRawArray($cliente)
            );

            $model->zonasInteres()->sync($cliente->getZonasInteres());

            return $model->id;
        });
    }

    public function saveTelefonos(int $clienteId, array $telefonos): void
    {
        DB::transaction(function () use ($clienteId, $telefonos) {
            $model = ClienteEloquentModel::findOrFail($clienteId);

            $telefonosValidos = array_filter($telefonos, function ($t) {
                return !empty($t['telefono']);
            });

            $idsEnviados = array_filter(array_column($telefonosValidos, 'id'));

            $model->telefonos()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($telefonosValidos as $datos) {
                $model->telefonos()->updateOrCreate(
                    ['id' => $datos['id'] ?? null],
                    [
                        'telefono'      => $datos['telefono'],
                        'tipo_telefono' => $datos['tipo_telefono'] ?? 'Celular',
                    ]
                );
            }
        });
    }

    public function saveReferencias(int $clienteId, array $referencias): void
    {
        DB::transaction(function () use ($clienteId, $referencias) {
            $model = ClienteEloquentModel::findOrFail($clienteId);

            $referenciasValidas = array_filter($referencias, function ($r) {
                return !empty($r['nombre']);
            });

            $idsEnviados = array_filter(array_column($referenciasValidas, 'id'));

            $model->referencias()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($referenciasValidas as $datos) {
                $model->referencias()->updateOrCreate(
                    ['id' => $datos['id'] ?? null],
                    [
                        'nombre'          => $datos['nombre'],
                        'celular'         => $datos['celular'] ?? null,
                        'parentesco'      => $datos['parentesco'] ?? null,
                        'asentamiento_id' => !empty($datos['asentamiento_id']) ? (int)$datos['asentamiento_id'] : null,
                        'calle_numero'    => $datos['calle_numero'] ?? null,
                    ]
                );
            }
        });
    }

    public function saveDocumentos(int $clienteId, array $documentos): void
    {
        DB::transaction(function () use ($clienteId, $documentos) {
            $model = ClienteEloquentModel::findOrFail($clienteId);

            $documentosValidos = array_filter($documentos, function ($d) {
                return !empty($d['url']) && !empty($d['tipo_documento']);
            });

            $idsEnviados = array_filter(array_column($documentosValidos, 'id'));

            $model->documentos()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($documentosValidos as $datos) {
                $model->documentos()->updateOrCreate(
                    ['id' => $datos['id'] ?? null],
                    [
                        'url'             => $datos['url'],
                        'nombre_original' => $datos['nombre_original'] ?? null,
                        'tipo_documento'  => $datos['tipo_documento'],
                        'peso_bytes'      => $datos['peso_bytes'] ?? null,
                        'verificado'      => (bool)($datos['verificado'] ?? false),
                    ]
                );
            }
        });
    }
    
    public function delete(int $id): bool
    {
        $modelo = ClienteEloquentModel::find($id);
        if (!$modelo) return false;

        return (bool) $modelo->delete();
    }
    
    private function toEntity(ClienteEloquentModel $modelo): Cliente
    {
        $telefonosDominio = $modelo->telefonos->map(function ($tel) {
            return new ClienteTelefono($tel->id, $tel->cliente_id, $tel->telefono, $tel->tipo_telefono);
        })->toArray();

        $referenciasDominio = $modelo->referencias->map(function ($ref) {
            return new ClienteReferencia($ref->id, $ref->cliente_id, $ref->nombre, $ref->celular, $ref->parentesco, $ref->asentamiento_id, $ref->calle_numero);
        })->toArray();

        $documentosDominio = $modelo->documentos->map(function ($doc) {
            return new ClienteDocumento(
                id: $doc->id,
                clienteId: $doc->cliente_id,
                url: $doc->url,
                nombreOriginal: $doc->nombre_original,
                tipoDocumento: $doc->tipo_documento,
                pesoBytes: $doc->peso_bytes,
                verificado: (bool)$doc->verificado
            );
        })->toArray();

        return new Cliente(
            id: $modelo->id,
            nombre: $modelo->nombre,
            apellidoPaterno: $modelo->apellido_paterno,
            apellidoMaterno: $modelo->apellido_materno,
            fechaNacimiento: $modelo->fecha_nacimiento ? new DateTime($modelo->fecha_nacimiento) : null,
            rfc: $modelo->rfc,
            curp: $modelo->curp,
            asentamientoId: $modelo->asentamiento_id,
            calleNumero: $modelo->calle_numero,
            nss: $modelo->nss,
            correoInfonavit: $modelo->correo_infonavit,
            contrasenaInfonavit: $modelo->contrasena_infonavit,
            tipoCreditoId: $modelo->tipo_redito_id,
            precalificacion: (float) $modelo->precalificacion,
            avaluoSolicitado: $modelo->avaluo_solicitado,
            estadoCivil: $modelo->estado_civil,
            regimenCasamiento: $modelo->regimen_casamiento,
            telefonos: $telefonosDominio,
            referencias: $referenciasDominio,
            documentos: $documentosDominio,
            zonasInteres: $modelo->zonasInteres->pluck('id')->toArray()
        );
    }

    private function toRawArray(Cliente $entidad): array
    {
        return [
            'nombre'               => $entidad->getNombre(),
            'apellido_paterno'     => $entidad->getApellidoPaterno(),
            'apellido_materno'     => $entidad->getApellidoMaterno(),
            'fecha_nacimiento'     => $entidad->getFechaNacimiento()?->format('Y-m-d'),
            'rfc'                  => $entidad->getRfc(),
            'curp'                 => $entidad->getCurp(),
            'asentamiento_id'      => $entidad->getAsentamientoId(),
            'calle_numero'         => $entidad->getCalleNumero(),
            'nss'                  => $entidad->getNss(),
            'correo_infonavit'     => $entidad->getCorreoInfonavit(),
            'contrasena_infonavit' => $entidad->getContrasenaInfonavit(),
            'tipo_redito_id'       => $entidad->getTipoCreditoId(),
            'precalificacion'      => $entidad->getPrecalificacion(),
            'avaluo_solicitado'    => $entidad->getAvalaoSolicitado(),
            'estado_civil'         => $entidad->getEstadoCivil(),
            'regimen_casamiento'   => $entidad->getRegimenCasamiento(),
        ];
    }
}