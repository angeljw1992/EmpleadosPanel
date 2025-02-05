@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contrato.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contratos.update", [$contrato->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="contrato_id">{{ trans('cruds.contrato.fields.contrato') }}</label>
                <select class="form-control select2 {{ $errors->has('contrato') ? 'is-invalid' : '' }}" name="contrato_id" id="contrato_id" required>
                    @foreach($contratos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('contrato_id') ? old('contrato_id') : $contrato->contrato->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contrato'))
                    <span class="text-danger">{{ $errors->first('contrato') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contrato.fields.contrato_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contratodesde">{{ trans('cruds.contrato.fields.contratodesde') }}</label>
                <input class="form-control date {{ $errors->has('contratodesde') ? 'is-invalid' : '' }}" type="text" name="contratodesde" id="contratodesde" value="{{ old('contratodesde', $contrato->contratodesde) }}" required>
                @if($errors->has('contratodesde'))
                    <span class="text-danger">{{ $errors->first('contratodesde') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contrato.fields.contratodesde_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contratohasta">{{ trans('cruds.contrato.fields.contratohasta') }}</label>
                <input class="form-control date {{ $errors->has('contratohasta') ? 'is-invalid' : '' }}" type="text" name="contratohasta" id="contratohasta" value="{{ old('contratohasta', $contrato->contratohasta) }}" required>
                @if($errors->has('contratohasta'))
                    <span class="text-danger">{{ $errors->first('contratohasta') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contrato.fields.contratohasta_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.contrato.fields.contratoestado') }}</label>
                <select class="form-control {{ $errors->has('contratoestado') ? 'is-invalid' : '' }}" name="contratoestado" id="contratoestado" required>
                    <option value disabled {{ old('contratoestado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Contrato::CONTRATOESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('contratoestado', $contrato->contratoestado) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('contratoestado'))
                    <span class="text-danger">{{ $errors->first('contratoestado') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contrato.fields.contratoestado_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection