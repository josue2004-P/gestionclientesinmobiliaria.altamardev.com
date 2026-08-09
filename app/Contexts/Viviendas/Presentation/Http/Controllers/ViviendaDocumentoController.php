<?php

namespace App\Contexts\Viviendas\Presentation\Http\Controllers;

use App\Contexts\Shared\Infrastructure\Controllers\Controller;
use App\Contexts\Viviendas\Infrastructure\LaravelModels\ViviendaDocumentoEloquentModel;
use Illuminate\Support\Facades\Storage;

class ViviendaDocumentoController extends Controller
{
    public function download($id)
    {
        $documento = ViviendaDocumentoEloquentModel::findOrFail($id);

        if (!Storage::disk('local')->exists($documento->url)) {
            abort(404, 'El archivo físico no se encuentra en el almacenamiento privado del servidor.');
        }

        return Storage::disk('local')->response(
            $documento->url, 
            $documento->nombre_original
        );
    }
}