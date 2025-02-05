<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContratoRequest;
use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Models\Contrato;
use App\Models\Empleado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContratosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contrato_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contratos = Contrato::with(['contrato'])->get();

        return view('admin.contratos.index', compact('contratos'));
    }

    public function create()
    {
        abort_if(Gate::denies('contrato_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contratos = Empleado::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contratos.create', compact('contratos'));
    }

    public function store(StoreContratoRequest $request)
    {
        $contrato = Contrato::create($request->all());

        return redirect()->route('admin.contratos.index');
    }

    public function edit(Contrato $contrato)
    {
        abort_if(Gate::denies('contrato_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contratos = Empleado::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contrato->load('contrato');

        return view('admin.contratos.edit', compact('contrato', 'contratos'));
    }

    public function update(UpdateContratoRequest $request, Contrato $contrato)
    {
        $contrato->update($request->all());

        return redirect()->route('admin.contratos.index');
    }

    public function show(Contrato $contrato)
    {
        abort_if(Gate::denies('contrato_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contrato->load('contrato');

        return view('admin.contratos.show', compact('contrato'));
    }

    public function destroy(Contrato $contrato)
    {
        abort_if(Gate::denies('contrato_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contrato->delete();

        return back();
    }

    public function massDestroy(MassDestroyContratoRequest $request)
    {
        $contratos = Contrato::find(request('ids'));

        foreach ($contratos as $contrato) {
            $contrato->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
