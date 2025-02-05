@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.empresa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.empresas.update", [$empresa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="businessname">{{ trans('cruds.empresa.fields.businessname') }}</label>
                <input class="form-control {{ $errors->has('businessname') ? 'is-invalid' : '' }}" type="text" name="businessname" id="businessname" value="{{ old('businessname', $empresa->businessname) }}">
                @if($errors->has('businessname'))
                    <span class="text-danger">{{ $errors->first('businessname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empresa.fields.businessname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ruc">{{ trans('cruds.empresa.fields.ruc') }}</label>
                <input class="form-control {{ $errors->has('ruc') ? 'is-invalid' : '' }}" type="text" name="ruc" id="ruc" value="{{ old('ruc', $empresa->ruc) }}" required>
                @if($errors->has('ruc'))
                    <span class="text-danger">{{ $errors->first('ruc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empresa.fields.ruc_helper') }}</span>
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