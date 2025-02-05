@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.documento.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.documento.fields.id') }}
                        </th>
                        <td>
                            {{ $documento->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documento.fields.empleado') }}
                        </th>
                        <td>
                            {{ $documento->empleado->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documento.fields.carne_verde') }}
                        </th>
                        <td>
                            @if($documento->carne_verde)
                                <a href="{{ $documento->carne_verde->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documento.fields.fecha_vencimiento_verde') }}
                        </th>
                        <td>
                            {{ $documento->fecha_vencimiento_verde }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documento.fields.carne_blanco') }}
                        </th>
                        <td>
                            @if($documento->carne_blanco)
                                <a href="{{ $documento->carne_blanco->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documento.fields.fecha_vencimiento_blanco') }}
                        </th>
                        <td>
                            {{ $documento->fecha_vencimiento_blanco }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documentos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection