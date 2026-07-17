<?php

namespace App\Contexts\Shared\Presentation\Livewire\Asentamientos;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetAsentamientosPaginatedUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\DeleteAsentamientoUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\BulkInsertAsentamientosUseCase;

class IndexAsentamientos extends Component
{
    use WithPagination;
    use WithFileUploads;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 10;

    public $excelFile;

    public function mount()
    {
        if (!checkPermiso('asentamientos.is_read')) {
            abort(403, 'Acceso denegado.');
        }
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function import()
    {
        $this->validate([
            'excelFile' => 'required|file|max:10240',
        ], [
            'excelFile.required' => 'Por favor, seleccione un archivo.',
        ]);

        $extension = strtolower($this->excelFile->getClientOriginalExtension());
        if (!in_array($extension, ['xls', 'xlsx'])) {
            $this->addError('excelFile', 'El formato debe ser estrictamente Excel (.xls o .xlsx).');
            $this->reset('excelFile');
            return;
        }

        $this->dispatch('swal-confirm', [
            'title'              => '¿Importar Asentamientos?',
            'text'               => 'Se procesarán los registros contenidos en el archivo para actualizar el catálogo.',
            'icon'               => 'question',
            'id'                 => null, 
            'function'           => 'execute-import',
            'confirmButtonText'  => 'Sí, procesar catálogo',
            'confirmButtonColor' => '#4f46e5',              
        ]);
    }

    #[On('execute-import')]
    public function executeImport(BulkInsertAsentamientosUseCase $bulkUseCase) 
    {
        if (!checkPermiso('asentamientos.is_update')) {
            $this->dispatch('swal-init', [
                'icon'  => 'error', 
                'title' => 'Acceso Denegado', 
                'text'  => 'No tienes permisos para modificar asentamientos.'
            ]);
            return;
        }

        if (!$this->excelFile) {
            $this->addError('excelFile', 'El archivo temporal ya no se encuentra disponible.');
            return;
        }

        try {
            $filePath = $this->excelFile->getRealPath();
            $contenido = file_get_contents($filePath);

            $esHtmlDisfrazado = stripos($contenido, '<table') !== false;

            $filas = $esHtmlDisfrazado
                ? $this->parseCatalogoCorreosMexico($contenido)
                : $this->parseXlsBinario($filePath);

            if ($filas === null || empty($filas)) {
                throw new \Exception('No se encontraron filas procesables en el documento.');
            }

            $loteAsentamientos = [];

            foreach ($filas as $fila) {
                if (empty($fila[0]) || empty($fila[5])) {
                    continue; 
                }

                $loteAsentamientos[] = [
                    'codigo_postal'       => trim((string)$fila[0]),
                    'estado'              => trim(htmlspecialchars_decode((string)$fila[1], ENT_QUOTES)),
                    'municipio'           => trim(htmlspecialchars_decode((string)$fila[2], ENT_QUOTES)),
                    'ciudad'              => !empty($fila[3]) ? trim(htmlspecialchars_decode((string)$fila[3], ENT_QUOTES)) : null,
                    'tipo_asentamiento'   => trim(htmlspecialchars_decode((string)$fila[4], ENT_QUOTES)),
                    'nombre_asentamiento' => trim(htmlspecialchars_decode((string)$fila[5], ENT_QUOTES)),
                ];
            }

            if (count($loteAsentamientos) > 0) {
                \DB::transaction(function () use ($bulkUseCase, $loteAsentamientos) {
                    $bulkUseCase->execute($loteAsentamientos);
                });
            }

            $this->reset('excelFile');
            $this->resetPage(); 

            $this->dispatch('swal-init', [
                'icon'  => 'success', 
                'title' => '¡Importación Exitosa!', 
                'text'  => 'El catálogo de ubicaciones se ha actualizado correctamente.'
            ]);

        } catch (\Exception $e) {
            $this->reset('excelFile');
            $this->addError('excelFile', 'Error al procesar la importación: ' . $e->getMessage());
        }
    }

    private function parseCatalogoCorreosMexico(string $contenido): ?array
    {
        $contenidoUtf8 = mb_convert_encoding($contenido, 'UTF-8', 'Windows-1252');

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        
        $meta = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $dom->loadHTML($meta . $contenidoUtf8, LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $tablas = $dom->getElementsByTagName('table');
        if ($tablas->length === 0) {
            return null;
        }

        $tablaDatos = null;
        foreach ($tablas as $tabla) {
            if ($tabla->getAttribute('id') === 'Datagrid1') {
                $tablaDatos = $tabla;
                break;
            }
        }
        $tablaDatos = $tablaDatos ?? $tablas->item($tablas->length - 1);

        $filas = [];
        foreach ($tablaDatos->getElementsByTagName('tr') as $indice => $fila) {
            $celdas = [];
            foreach ($fila->getElementsByTagName('td') as $celda) {
                // Limpieza y remoción de espacios duros HTML (&nbsp;) no romper cadenas
                $texto = str_replace("\xc2\xa0", ' ', $celda->textContent);
                $celdas[] = trim($texto);
            }
            if (empty($celdas)) {
                continue;
            }
            if ($indice === 0) {
                continue; 
            }
            $filas[] = $celdas;
        }

        return $filas;
    }

    private function parseXlsBinario(string $filePath): ?array
    {
        if (!$xlsx = \Shuchkin\SimpleXLSX::parse($filePath)) {
            return null;
        }
        $filas = $xlsx->rows();
        array_shift($filas);
        array_shift($filas);
        return $filas;
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar asentamiento?',
            'text'  => 'Esta acción removerá definitivamente la ubicación del catálogo.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-asentamiento',
        ]);
    }

    #[On('delete-asentamiento')]
    public function deleteAsentamiento($id, DeleteAsentamientoUseCase $useCase)
    {
        if (!checkPermiso('asentamientos.is_update')) {
            $this->dispatch('swal-init', [
                'icon' => 'error', 
                'title' => 'Acceso Denegado', 
                'text' => 'No tienes permisos para modificar asentamientos.'
            ]);
            return;
        }

        $useCase->execute((int)$id);
        
        $this->dispatch('swal-init', [
            'icon' => 'success', 
            'title' => 'Eliminado', 
            'text' => 'El asentamiento ha sido eliminado correctamente.'
        ]);
    }

    public function render(GetAsentamientosPaginatedUseCase $getUseCase)
    {
        return view('shared::asentamientos.index', [
            'asentamientos' => $getUseCase->execute($this->search, (int)$this->perPage)
        ])
        ->layout('shared::layouts.app') 
        ->title('Gestión de Asentamientos');
    }
}