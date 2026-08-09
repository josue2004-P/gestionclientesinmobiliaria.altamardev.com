<?php

namespace App\Contexts\Viviendas\Presentation\Http\Controllers;

use App\Contexts\Shared\Infrastructure\Controllers\Controller;
use App\Contexts\Viviendas\Infrastructure\LaravelModels\ViviendaFotoEloquentModel;
use Illuminate\Support\Facades\Storage;

class ViviendaFotoController extends Controller
{
    public function show($id)
    {
        $foto = ViviendaFotoEloquentModel::findOrFail($id);

        if (!Storage::disk('local')->exists($foto->url)) {
            abort(404);
        }

        return Storage::disk('local')->response($foto->url);
    }
}