@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contrato.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contratos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contrato.fields.contrato') }}
                        </th>
                        <td>
                            {{ $contrato->contrato->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contrato.fields.contratodesde') }}
                        </th>
                        <td>
                            {{ $contrato->contratodesde }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contrato.fields.contratohasta') }}
                        </th>
                        <td>
                            {{ $contrato->contratohasta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contrato.fields.contratoestado') }}
                        </th>
                        <td>
                            {{ App\Models\Contrato::CONTRATOESTADO_SELECT[$contrato->contratoestado] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contratos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection