<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEmpleadoRequest;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Contrato;
use App\Models\Empleado;
use App\Models\Empresa;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EmpleadosController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('empleado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::with(['unidad_de_negocio', 'contrato_desde', 'media'])->get();

        return view('admin.empleados.index', compact('empleados'));
    }

    public function create()
    {
        abort_if(Gate::denies('empleado_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unidad_de_negocios = Empresa::pluck('businessname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contrato_desdes = Contrato::pluck('contratodesde', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.empleados.create', compact('contrato_desdes', 'unidad_de_negocios'));
    }

    public function store(StoreEmpleadoRequest $request)
    {
        $empleado = Empleado::create($request->all());

        if ($request->input('profilepic', false)) {
            $empleado->addMedia(storage_path('tmp/uploads/' . basename($request->input('profilepic'))))->toMediaCollection('profilepic');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $empleado->id]);
        }

        return redirect()->route('admin.empleados.index');
    }

    public function edit(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unidad_de_negocios = Empresa::pluck('businessname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contrato_desdes = Contrato::pluck('contratodesde', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleado->load('unidad_de_negocio', 'contrato_desde');

        return view('admin.empleados.edit', compact('contrato_desdes', 'empleado', 'unidad_de_negocios'));
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

        return redirect()->route('admin.empleados.index');
    }

    public function show(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado->load('unidad_de_negocio', 'contrato_desde', 'contratoContratos', 'empleadoDocumentos');

        return view('admin.empleados.show', compact('empleado'));
    }

    public function destroy(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmpleadoRequest $request)
    {
        $empleados = Empleado::find(request('ids'));

        foreach ($empleados as $empleado) {
            $empleado->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('empleado_create') && Gate::denies('empleado_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Empleado();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
