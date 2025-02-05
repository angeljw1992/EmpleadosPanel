@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.empleado.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.empleados.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_employee">{{ trans('cruds.empleado.fields.id_employee') }}</label>
                <input class="form-control {{ $errors->has('id_employee') ? 'is-invalid' : '' }}" type="number" name="id_employee" id="id_employee" value="{{ old('id_employee', '') }}" step="1" required>
                @if($errors->has('id_employee'))
                    <span class="text-danger">{{ $errors->first('id_employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.id_employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.empleado.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_names">{{ trans('cruds.empleado.fields.last_names') }}</label>
                <input class="form-control {{ $errors->has('last_names') ? 'is-invalid' : '' }}" type="text" name="last_names" id="last_names" value="{{ old('last_names', '') }}" required>
                @if($errors->has('last_names'))
                    <span class="text-danger">{{ $errors->first('last_names') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.last_names_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cedula">{{ trans('cruds.empleado.fields.cedula') }}</label>
                <input class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}" type="text" name="cedula" id="cedula" value="{{ old('cedula', '') }}" required>
                @if($errors->has('cedula'))
                    <span class="text-danger">{{ $errors->first('cedula') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.cedula_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profilepic">{{ trans('cruds.empleado.fields.profilepic') }}</label>
                <div class="needsclick dropzone {{ $errors->has('profilepic') ? 'is-invalid' : '' }}" id="profilepic-dropzone">
                </div>
                @if($errors->has('profilepic'))
                    <span class="text-danger">{{ $errors->first('profilepic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.profilepic_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="direccion">{{ trans('cruds.empleado.fields.direccion') }}</label>
                <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text" name="direccion" id="direccion" value="{{ old('direccion', '') }}" required>
                @if($errors->has('direccion'))
                    <span class="text-danger">{{ $errors->first('direccion') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.direccion_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unidad_de_negocio_id">{{ trans('cruds.empleado.fields.unidad_de_negocio') }}</label>
                <select class="form-control select2 {{ $errors->has('unidad_de_negocio') ? 'is-invalid' : '' }}" name="unidad_de_negocio_id" id="unidad_de_negocio_id" required>
                    @foreach($unidad_de_negocios as $id => $entry)
                        <option value="{{ $id }}" {{ old('unidad_de_negocio_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('unidad_de_negocio'))
                    <span class="text-danger">{{ $errors->first('unidad_de_negocio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.unidad_de_negocio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contrato_desde_id">{{ trans('cruds.empleado.fields.contrato_desde') }}</label>
                <select class="form-control select2 {{ $errors->has('contrato_desde') ? 'is-invalid' : '' }}" name="contrato_desde_id" id="contrato_desde_id">
                    @foreach($contrato_desdes as $id => $entry)
                        <option value="{{ $id }}" {{ old('contrato_desde_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contrato_desde'))
                    <span class="text-danger">{{ $errors->first('contrato_desde') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.contrato_desde_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fecha_nacimiento">{{ trans('cruds.empleado.fields.fecha_nacimiento') }}</label>
                <input class="form-control date {{ $errors->has('fecha_nacimiento') ? 'is-invalid' : '' }}" type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                @if($errors->has('fecha_nacimiento'))
                    <span class="text-danger">{{ $errors->first('fecha_nacimiento') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.empleado.fields.fecha_nacimiento_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.profilepicDropzone = {
    url: '{{ route('admin.empleados.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 1024,
      height: 1024
    },
    success: function (file, response) {
      $('form').find('input[name="profilepic"]').remove()
      $('form').append('<input type="hidden" name="profilepic" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="profilepic"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($empleado) && $empleado->profilepic)
      var file = {!! json_encode($empleado->profilepic) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="profilepic" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection