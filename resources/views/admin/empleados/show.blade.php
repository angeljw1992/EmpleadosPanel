@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.empleado.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empleados.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.id_employee') }}
                        </th>
                        <td>
                            {{ $empleado->id_employee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.first_name') }}
                        </th>
                        <td>
                            {{ $empleado->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.last_names') }}
                        </th>
                        <td>
                            {{ $empleado->last_names }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.cedula') }}
                        </th>
                        <td>
                            {{ $empleado->cedula }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.profilepic') }}
                        </th>
                        <td>
                            @if($empleado->profilepic)
                                <a href="{{ $empleado->profilepic->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $empleado->profilepic->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.direccion') }}
                        </th>
                        <td>
                            {{ $empleado->direccion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.correo') }}
                        </th>
                        <td>
                            {{ $empleado->correo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.unidad_de_negocio') }}
                        </th>
                        <td>
                            {{ $empleado->unidad_de_negocio->businessname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.contrato_desde') }}
                        </th>
                        <td>
                            {{ $empleado->contrato_desde->contratodesde ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empleado.fields.fecha_nacimiento') }}
                        </th>
                        <td>
                            {{ $empleado->fecha_nacimiento }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.empleados.index') }}">
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
            <a class="nav-link" href="#contrato_contratos" role="tab" data-toggle="tab">
                {{ trans('cruds.contrato.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#empleado_documentos" role="tab" data-toggle="tab">
                {{ trans('cruds.documento.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="contrato_contratos">
            @includeIf('admin.empleados.relationships.contratoContratos', ['contratos' => $empleado->contratoContratos])
        </div>
        <div class="tab-pane" role="tabpanel" id="empleado_documentos">
            @includeIf('admin.empleados.relationships.empleadoDocumentos', ['documentos' => $empleado->empleadoDocumentos])
        </div>
    </div>
</div>

@endsection