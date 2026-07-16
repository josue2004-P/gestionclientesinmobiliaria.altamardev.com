<?php

namespace App\Contexts\Clientes\Presentation\Http\Controllers;

use App\Contexts\Shared\Infrastructure\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class VerClienteDocumentoController extends Controller
{
    /**
     * Previsualiza de forma segura un documento del expediente de un cliente.
     */
    public function __invoke(Request $request): BinaryFileResponse
    {
        if (!auth()->check() || (!checkPermiso('clientes.is_update') && !checkPermiso('clientes.is_read'))) {
            abort(403, 'No tienes permisos para consultar este expediente de cliente.');
        }

        $path = $request->query('path');

        if (!$path || !Storage::disk('local')->exists($path)) {
            abort(404, 'El documento solicitado no existe en el expediente del cliente.');
        }

        $absolutePath = Storage::disk('local')->path($path);

        return response()->file($absolutePath, [
            'Content-Disposition' => 'inline'
        ]);
    }
}