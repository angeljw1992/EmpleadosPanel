<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Http\Resources\Admin\EmpleadoResource;
use App\Models\Empleado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpleadosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('empleado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmpleadoResource(Empleado::with(['unidad_de_negocio', 'contrato_desde'])->get());
    }

    public function store(StoreEmpleadoRequest $request)
    {
        $empleado = Empleado::create($request->all());

        if ($request->input('profilepic', false)) {
            $empleado->addMedia(storage_path('tmp/uploads/' . basename($request->input('profilepic'))))->toMediaCollection('profilepic');
        }

        return (new EmpleadoResource($empleado))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmpleadoResource($empleado->load(['unidad_de_negocio', 'contrato_desde']));
    }

    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        $empleado->update($request->all());

        if ($request->input('profilepic', false)) {
            if (! $empleado->profilepic || $request->input('profilepic') !== $empleado->profilepic->file_name) {
                if ($empleado->profilepic) {
                    $empleado->profilepic->delete();
                }
                $empleado->addMedia(storage_path('tmp/uploads/' . basename($request->input('profilepic'))))->toMediaCollection('profilepic');
            }
        } elseif ($empleado->profilepic) {
            $empleado->profilepic->delete();
        }

        return (new EmpleadoResource($empleado))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
