<?php

namespace App\Contexts\Clientes\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditClienteRequest extends FormRequest
{
    private ?int $clienteId = null;

    public function __construct(?int $clienteId = null)
    {
        parent::__construct();
        $this->clienteId = $clienteId;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'               => 'required|string|max:255',
            'apellido_paterno'     => 'required|string|max:255',
            'apellido_materno'     => 'required|string|max:255',
            'fecha_nacimiento'     => 'nullable|date',
            'rfc'                  => 'nullable|string|max:13|unique:clientes,rfc,' . $this->clienteId,
            'curp'                 => 'nullable|string|max:18|unique:clientes,curp,' . $this->clienteId,
            'asentamiento_id'      => 'nullable|integer|exists:asentamientos,id',
            'calle_numero'         => 'nullable|string|max:255',
            'nss'                  => 'nullable|string|max:15',
            'correo_infonavit'     => 'nullable|email|max:255',
            'contrasena_infonavit' => 'nullable|string|max:255',
            'tipo_credito_id'      => 'nullable|integer',
            'precalificacion'      => 'numeric|min:0',
            'avaluo_solicitado'    => 'required|in:Sí,No',
            'estado_civil'         => 'nullable|in:Soltero,Casado,Divorciado,Viudo,Union_Libre',
            'regimen_casamiento'   => 'nullable|string|max:100',

            // Relaciones (1:N)
            'zonas_ids'                 => 'nullable|array',
            'zonas_ids.*'               => 'integer|exists:asentamientos,id',
            'telefonos'                 => 'required|array|min:1',
            'telefonos.*.id'            => 'nullable|integer',
            'telefonos.*.telefono'      => 'required|string|min:8|max:20',
            'telefonos.*.tipo_telefono' => 'required|string|max:50',
            'referencias'               => 'nullable|array',
            'referencias.*.id'          => 'nullable|integer',
            'referencias.*.nombre'      => 'required|string|max:255',
            'referencias.*.celular'     => 'nullable|string|max:20',
            'referencias.*.parentesco'  => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            // Reglas generales
            'required' => 'El campo :attribute es obligatorio.',
            'string'   => 'El campo :attribute debe ser una cadena de texto.',
            'max'      => 'El campo :attribute no debe superar los :max caracteres.',
            'min'      => 'El campo :attribute debe tener al menos :min caracteres.',
            'date'     => 'El campo :attribute debe ser una fecha válida.',
            'email'    => 'El campo :attribute debe ser un correo electrónico válido.',
            'numeric'  => 'El campo :attribute debe ser un número válido.',
            'integer'  => 'El campo :attribute debe ser un número entero.',
            'unique'   => 'El :attribute ingresado ya se encuentra registrado por otro cliente.',
            'exists'   => 'El :attribute seleccionado no es válido.',
            'in'       => 'El valor seleccionado para :attribute no es válido.',
            'array'    => 'El campo :attribute debe ser una lista válida.',

            // Teléfonos
            'telefonos.required'                 => 'Debe agregar al menos un número de teléfono.',
            'telefonos.min'                      => 'Debe agregar al menos un número de teléfono.',
            'telefonos.*.telefono.required'      => 'El número de teléfono es obligatorio.',
            'telefonos.*.telefono.min'           => 'El número de teléfono debe tener al menos :min dígitos.',
            'telefonos.*.telefono.max'           => 'El número de teléfono no debe exceder los :max dígitos.',
            'telefonos.*.tipo_telefono.required' => 'El tipo de línea es obligatorio.',

            // Referencias
            'referencias.*.nombre.required'      => 'El nombre de la referencia es obligatorio.',
            'referencias.*.nombre.max'           => 'El nombre de la referencia no debe superar los :max caracteres.',
            'referencias.*.celular.max'          => 'El teléfono celular no debe exceder los :max dígitos.',
            'referencias.*.parentesco.max'       => 'El vínculo/relación no debe superar los :max caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre'                 => 'nombre',
            'apellido_paterno'       => 'apellido paterno',
            'apellido_materno'       => 'apellido materno',
            'fecha_nacimiento'       => 'fecha de nacimiento',
            'rfc'                    => 'RFC',
            'curp'                   => 'CURP',
            'asentamiento_id'        => 'asentamiento/ubicación',
            'calle_numero'           => 'calle y número',
            'nss'                    => 'NSS',
            'correo_infonavit'       => 'correo Infonavit',
            'contrasena_infonavit'   => 'contraseña Infonavit',
            'tipo_credito_id'        => 'tipo de crédito',
            'precalificacion'        => 'monto de precalificación',
            'avaluo_solicitado'      => 'avalúo solicitado',
            'estado_civil'           => 'estado civil',
            'regimen_casamiento'     => 'régimen patrimonial',
            'zonas_ids'              => 'zonas de interés',
            'telefonos'                 => 'teléfonos',
            'telefonos.*.telefono'      => 'número de teléfono',
            'telefonos.*.tipo_telefono' => 'tipo de línea',
            'referencias'               => 'referencias',
            'referencias.*.nombre'      => 'nombre de la referencia',
            'referencias.*.celular'     => 'teléfono celular',
            'referencias.*.parentesco'  => 'vínculo o relación',
        ];
    }
}