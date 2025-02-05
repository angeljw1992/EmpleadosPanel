<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Resources\Admin\DocumentoResource;
use App\Models\Documento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('documento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentoResource(Documento::with(['empleado'])->get());
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

        return (new DocumentoResource($documento))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Documento $documento)
    {
        abort_if(Gate::denies('documento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentoResource($documento->load(['empleado']));
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

        return (new DocumentoResource($documento))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Documento $documento)
    {
        abort_if(Gate::denies('documento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documento->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
