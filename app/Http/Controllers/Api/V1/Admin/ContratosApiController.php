<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Http\Resources\Admin\ContratoResource;
use App\Models\Contrato;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContratosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contrato_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContratoResource(Contrato::with(['contrato'])->get());
    }

    public function store(StoreContratoRequest $request)
    {
        $contrato = Contrato::create($request->all());

        return (new ContratoResource($contrato))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Contrato $contrato)
    {
        abort_if(Gate::denies('contrato_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContratoResource($contrato->load(['contrato']));
    }

    public function update(UpdateContratoRequest $request, Contrato $contrato)
    {
        $contrato->update($request->all());

        return (new ContratoResource($contrato))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Contrato $contrato)
    {
        abort_if(Gate::denies('contrato_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contrato->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
