@extends('layouts.admin')
@section('content')
@can('empleado_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.empleados.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.empleado.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Empleado', 'route' => 'admin.empleados.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.empleado.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Empleado">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.id_employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.last_names') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.cedula') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.profilepic') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.unidad_de_negocio') }}
                        </th>
                        <th>
                            {{ trans('cruds.empleado.fields.contrato_desde') }}
                        </th>
                        <th>
                            {{ trans('cruds.contrato.fields.contratohasta') }}
                        </th>
                        <th>
                            {{ trans('cruds.contrato.fields.contratoestado') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $key => $empleado)
                        <tr data-entry-id="{{ $empleado->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $empleado->id_employee ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->last_names ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->cedula ?? '' }}
                            </td>
                            <td>
                                @if($empleado->profilepic)
                                    <a href="{{ $empleado->profilepic->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $empleado->profilepic->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $empleado->unidad_de_negocio->businessname ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->contrato_desde->contratodesde ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->contrato_desde->contratohasta ?? '' }}
                            </td>
                            <td>
                                @if($empleado->contrato_desde)
                                    {{ $empleado->contrato_desde::CONTRATOESTADO_SELECT[$empleado->contrato_desde->contratoestado] ?? '' }}
                                @endif
                            </td>
                            <td>
                                @can('empleado_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.empleados.show', $empleado->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('empleado_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.empleados.edit', $empleado->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('empleado_delete')
                                    <form action="{{ route('admin.empleados.destroy', $empleado->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('empleado_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.empleados.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Empleado:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection