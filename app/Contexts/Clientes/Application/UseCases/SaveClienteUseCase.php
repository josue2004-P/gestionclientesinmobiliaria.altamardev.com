<?php

namespace App\Contexts\Clientes\Application\UseCases;

use App\Contexts\Clientes\Domain\Entities\Cliente;
use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;
use DateTime;

class SaveClienteUseCase
{
    public function __construct(
        private ClienteRepositoryInterface $repository
    ) {}

    public function execute(array $data): Cliente
    {
        $cliente = new Cliente(
            id: null,
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
            zonasInteres: $data['zonas_interes'] ?? []
        );

        return $this->repository->save($cliente);
    }
}