@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.empresa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empresas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.id') }}
                        </th>
                        <td>
                            {{ $empresa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.businessname') }}
                        </th>
                        <td>
                            {{ $empresa->businessname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empresa.fields.ruc') }}
                        </th>
                        <td>
                            {{ $empresa->ruc }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empresas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#unidad_de_negocio_empleados" role="tab" data-toggle="tab">
                {{ trans('cruds.empleado.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="unidad_de_negocio_empleados">
            @includeIf('admin.empresas.relationships.unidadDeNegocioEmpleados', ['empleados' => $empresa->unidadDeNegocioEmpleados])
        </div>
    </div>
</div>

@endsection