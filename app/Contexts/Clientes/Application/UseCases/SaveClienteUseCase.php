<?php

namespace App\Contexts\Clientes\Application\UseCases;

use App\Contexts\Clientes\Domain\Entities\Cliente;
use App\Contexts\Clientes\Domain\Entities\ClienteTelefono;
use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;
use DateTime;

class SaveClienteUseCase
{
    public function __construct(
        private ClienteRepositoryInterface $repository
    ) {}

    public function execute(array $data): int // 🟢 Corregido a int
    {
        $telefonosDominio = [];
        if (!empty($data['telefonos']) && is_array($data['telefonos'])) {
            foreach ($data['telefonos'] as $tel) {
                $telefonosDominio[] = new ClienteTelefono(
                    id: $tel['id'] ?? null,
                    clienteId: $data['id'] ?? null,
                    telefono: $tel['telefono'],
                    tipoTelefono: $tel['tipo_telefono'] ?? 'Celular'
                );
            }
        }
        
        $cliente = new Cliente(
            id: $data['id'] ?? null,
            nombre: $data['nombre'],
            apellidoPaterno: $data['apellido_paterno'],
            apellidoMaterno: $data['apellido_materno'],
            fechaNacimiento: isset($data['fecha_nacimiento']) ? new DateTime($data['fecha_nacimiento']) : null,
            rfc: $data['rfc'] ?? null,
            curp: $data['curp'] ?? null,
            asentamientoId: $data['asentamiento_id'] ?? null,
            calleNumero: $data['calle_numero'] ?? null,
            nss: $data['nss'] ?? null,
            correoInfonavit: $data['correo_infonavit'] ?? null,
            contrasenaInfonavit: $data['contrasena_infonavit'] ?? null,
            tipoCreditoId: $data['tipo_credito_id'] ?? null,
            precalificacion: (float) ($data['precalificacion'] ?? 0),
            avaluoSolicitado: $data['avaluo_solicitado'] ?? 'No',
            estadoCivil: $data['estado_civil'] ?? null,
            regimenCasamiento: $data['regimen_casamiento'] ?? null,
            telefonos: $telefonosDominio,
            referencias: [],
            documentos: [],
            zonasInteres: $data['zonas_ids'] ?? [] 
        );

        return $this->repository->save($cliente);
    }
}