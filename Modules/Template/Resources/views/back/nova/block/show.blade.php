@extends ('template::back.nova.layouts.main')

@section ('importcss')
    <!-- NProgress -->
    <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
@stop

@section ('content')

@if (session('result'))
<div class="alert alert-info" role="alert">
  {{ session('result') }}
</div>
@endif

<div class="x_panel">
        <div class="x_title">
          <h2>Все блоки
            <!-- CREATE -->
            <a href="/dashboard/block/create/">
              <button type="button" class="btn btn-primary btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
            </a>

            <!-- INFO -->
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoModal">
              <i class="fa fa-question" aria-hidden="true"></i>
            </button>

          </h2>
          <div class="clearfix"></div>
        </div>

        <!--  modal info -->
        @includeIf ('template::back.nova.block.info')

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <thead>
                <th>ID</th>
                <th>Описание</th>
                <th>Дата создания</th>
                <th>Доступ</th>
                <th>Дата обновления</th>
                <th>Действия</th>
            </thead>

            <tbody>
                @foreach ($blocks as $block)
                <tr>
                    <td>{{ $block->id }}</td>
                    <td>{{ $block->description }}</td>
                    <td>{{ $block->created_at->format('d/m/Y h:m:s') }}</td>
                    <td>{{ $block->role->title }}</td>
                    <td>{{ $block->updated_at->format('d/m/Y h:m:s') }}</td>
                    <td>
                      <p>
                        <!-- EDIT -->
                        <a href="/dashboard/block/edit/{{ $block->id }}">
                          <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                          </button>
                        </a>

                        <!-- DELETE -->
                        <a class="btn btn-danger btn-sm" href="/dashboard/block/{{ $block->id }}"
                            onclick="event.preventDefault();
                                     document.getElementById('destroy-form{{ $block->id }}').submit();">
                                     <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>

                        <form id="destroy-form{{ $block->id }}" action="/dashboard/block/{{ $block->id }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                      </p>
                    </td>
                </tr>
                @endforeach
            </tbody>

          </table>
          <hr>
          {{ $blocks->links() }}
        </div>
      </div>
@stop

@section ('importjs')
  <!-- FastClick -->
  <script src="/vendors/fastclick/lib/fastclick.js"></script>
  <!-- Datatables -->
  <script src="/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
@stop

@section ('localjs')
  $('#datatable-responsive').DataTable();
@stop
