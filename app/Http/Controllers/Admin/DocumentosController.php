<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocumentoRequest;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Models\Documento;
use App\Models\Empleado;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DocumentosController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('documento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentos = Documento::with(['empleado', 'media'])->get();

        return view('admin.documentos.index', compact('documentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('documento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.documentos.create', compact('empleados'));
    }

    public function store(StoreDocumentoRequest $request)
    {
        $documento = Documento::create($request->all());

        if ($request->input('carne_verde', false)) {
            $documento->addMedia(storage_path('tmp/uploads/' . basename($request->input('carne_verde'))))->toMediaCollection('carne_verde');
        }

        if ($request->input('carne_blanco', false)) {
            $documento->addMedia(storage_path('tmp/uploads/' . basename($request->input('carne_blanco'))))->toMediaCollection('carne_blanco');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $documento->id]);
        }

        return redirect()->route('admin.documentos.index');
    }

    public function edit(Documento $documento)
    {
        abort_if(Gate::denies('documento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documento->load('empleado');

        return view('admin.documentos.edit', compact('documento', 'empleados'));
    }

    public function update(UpdateDocumentoRequest $request, Documento $documento)
    {
        $documento->update($request->all());

        if ($request->input('carne_verde', false)) {
            if (! $documento->carne_verde || $request->input('carne_verde') !== $documento->carne_verde->file_name) {
                if ($documento->carne_verde) {
                    $documento->carne_verde->delete();
                }
                $documento->addMedia(storage_path('tmp/uploads/' . basename($request->input('carne_verde'))))->toMediaCollection('carne_verde');
            }
        } elseif ($documento->carne_verde) {
            $documento->carne_verde->delete();
        }

        if ($request->input('carne_blanco', false)) {
            if (! $documento->carne_blanco || $request->input('carne_blanco') !== $documento->carne_blanco->file_name) {
                if ($documento->carne_blanco) {
                    $documento->carne_blanco->delete();
                }
                $documento->addMedia(storage_path('tmp/uploads/' . basename($request->input('carne_blanco'))))->toMediaCollection('carne_blanco');
            }
        } elseif ($documento->carne_blanco) {
            $documento->carne_blanco->delete();
        }

        return redirect()->route('admin.documentos.index');
    }

    public function show(Documento $documento)
    {
        abort_if(Gate::denies('documento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documento->load('empleado');

        return view('admin.documentos.show', compact('documento'));
    }

    public function destroy(Documento $documento)
    {
        abort_if(Gate::denies('documento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documento->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentoRequest $request)
    {
        $documentos = Documento::find(request('ids'));

        foreach ($documentos as $documento) {
            $documento->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('documento_create') && Gate::denies('documento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Documento();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
