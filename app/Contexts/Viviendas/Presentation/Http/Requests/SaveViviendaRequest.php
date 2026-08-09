<?php

namespace App\Contexts\Viviendas\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveViviendaRequest extends FormRequest
{
    private ?int $viviendaId = null;

    public function __construct(?int $viviendaId = null)
    {
        parent::__construct();
        $this->viviendaId = $viviendaId;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fraccionamiento'  => 'nullable|string|max:255',
            'asentamiento_id'  => 'required|integer|exists:asentamientos,id',
            'tipo_vivienda_id' => 'required|integer|exists:tipos_vivienda,id',
            'precio_lista'     => 'required|numeric|min:0',
            'recamaras'        => 'required|integer|min:0',
            'direccion'        => 'required|string',
            'llaves'           => 'required|boolean',
            'estatus_vivienda' => 'required|in:Disponible,Apartada,Vendida,Rentada,Mantenimiento,Suspendida',
            'creditos_ids'     => 'nullable|array',
            'creditos_ids.*'   => 'integer',
            'amenidades_ids'   => 'nullable|array',
            'amenidades_ids.*' => 'integer',

            // Contactos en array (1:N)
            'contactos'           => 'nullable|array',
            'contactos.*.nombre'   => 'nullable|string|max:255',
            'contactos.*.relacion' => 'nullable|string|max:100',
            'contactos.*.telefono' => 'nullable|string|max:50',
            'contactos.*.correo'   => 'nullable|email|max:255',
            'contactos.*.notes'    => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string'   => 'El campo :attribute debe ser una cadena de texto.',
            'max'      => 'El campo :attribute no debe superar los :max caracteres.',
            'min'      => 'El campo :attribute debe tener al menos :min.',
            'numeric'  => 'El campo :attribute debe ser un número válido.',
            'integer'  => 'El campo :attribute debe ser un número entero.',
            'boolean'  => 'El campo :attribute debe ser un valor verdadero o falso.',
            'exists'   => 'El :attribute seleccionado no existe en el catálogo.',
            'in'       => 'El valor seleccionado para :attribute no es válido.',
            'array'    => 'El campo :attribute debe ser un listado de elementos válido.',
            'email'    => 'El correo del contacto debe tener un formato de email válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'fraccionamiento'  => 'fraccionamiento/desarrollo',
            'asentamiento_id'  => 'asentamiento/ubicación',
            'tipo_vivienda_id' => 'modelo o tipo de vivienda',
            'precio_lista'     => 'precio de lista',
            'recamaras'        => 'número de recámaras',
            'direccion'        => 'dirección exacta',
            'llaves'           => 'disponibilidad de llaves',
            'estatus_vivienda' => 'estatus de la vivienda',
            'creditos_ids'     => 'créditos aceptados',
            'amenidades_ids'   => 'amenidades seleccionadas',
            'contactos'        => 'lista de contactos',
            'contactos.*.nombre' => 'nombre del contacto',
            'contactos.*.correo' => 'correo del contacto',
        ];
    }
}