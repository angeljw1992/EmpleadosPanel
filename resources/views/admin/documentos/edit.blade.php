@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.documento.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.documentos.update", [$documento->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="empleado_id">{{ trans('cruds.documento.fields.empleado') }}</label>
                <select class="form-control select2 {{ $errors->has('empleado') ? 'is-invalid' : '' }}" name="empleado_id" id="empleado_id" required>
                    @foreach($empleados as $id => $entry)
                        <option value="{{ $id }}" {{ (old('empleado_id') ? old('empleado_id') : $documento->empleado->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('empleado'))
                    <span class="text-danger">{{ $errors->first('empleado') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documento.fields.empleado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="carne_verde">{{ trans('cruds.documento.fields.carne_verde') }}</label>
                <div class="needsclick dropzone {{ $errors->has('carne_verde') ? 'is-invalid' : '' }}" id="carne_verde-dropzone">
                </div>
                @if($errors->has('carne_verde'))
                    <span class="text-danger">{{ $errors->first('carne_verde') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documento.fields.carne_verde_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="carne_blanco">{{ trans('cruds.documento.fields.carne_blanco') }}</label>
                <div class="needsclick dropzone {{ $errors->has('carne_blanco') ? 'is-invalid' : '' }}" id="carne_blanco-dropzone">
                </div>
                @if($errors->has('carne_blanco'))
                    <span class="text-danger">{{ $errors->first('carne_blanco') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documento.fields.carne_blanco_helper') }}</span>
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
    Dropzone.options.carneVerdeDropzone = {
    url: '{{ route('admin.documentos.storeMedia') }}',
    maxFilesize: 1, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1
    },
    success: function (file, response) {
      $('form').find('input[name="carne_verde"]').remove()
      $('form').append('<input type="hidden" name="carne_verde" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="carne_verde"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($documento) && $documento->carne_verde)
      var file = {!! json_encode($documento->carne_verde) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="carne_verde" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.carneBlancoDropzone = {
    url: '{{ route('admin.documentos.storeMedia') }}',
    maxFilesize: 1, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1
    },
    success: function (file, response) {
      $('form').find('input[name="carne_blanco"]').remove()
      $('form').append('<input type="hidden" name="carne_blanco" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="carne_blanco"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($documento) && $documento->carne_blanco)
      var file = {!! json_encode($documento->carne_blanco) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="carne_blanco" value="' + file.file_name + '">')
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