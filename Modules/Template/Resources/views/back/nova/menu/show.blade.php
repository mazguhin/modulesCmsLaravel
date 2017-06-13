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
          <h2>Все меню
            <!-- CREATE -->
            <a href="/dashboard/menu/create/">
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
        @includeIf ('template::back.nova.menu.info')

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <th>Заголовок</th>
                <th>Создано</th>
                <th>Описание</th>
                <th>Активно</th>
                <th>Доступ</th>
                <th>URL</th>
                <th>Изменено</th>
                <th>Действия</th>
            </thead>

            <tbody>
                @foreach ($menus as $menu)
                <tr>
                    <td><i class="fa {{ $menu->icon }}"></i> {{ $menu->title }}</td>
                    <td>{{ $menu->created_at->format('d/m/Y h:m:s') }}</td>
                    <td>{{ $menu->description }}</td>
                    <td>
                      @if ($menu->activated==1) Активно @endif
                      @if ($menu->activated==0) Неактивно @endif
                    </td>
                    <td>{{ $menu->access->title }}</td>
                    <td>{{ $menu->url }}</td>
                    <td>{{ $menu->updated_at->format('d/m/Y h:m:s') }}</td>
                    <td>

                      <p>
                        <!-- EDIT -->
                        <a href="/dashboard/menu/edit/id/{{ $menu->id }}">
                          <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                          </button>
                        </a>


                      @if (empty($menu->url))

                        <!-- edit items menu -->
                        <a href="/dashboard/menu/item/id/{{ $menu->id }}">
                          <button type="button" class="btn btn-default btn-sm">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                          </button>
                        </a>

                      @endif

                      @if ($menu->required==0)
                        <!-- DELETE -->
                        <a href="/dashboard/menu/delete/id/{{ $menu->id }}">
                          <a class="btn btn-danger btn-sm" href="/dashboard/menu/{{ $menu->id }}"
                              onclick="event.preventDefault();
                                       document.getElementById('destroy-form{{ $menu->id }}').submit();">
                                       <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>

                          <form id="destroy-form{{ $menu->id }}" action="/dashboard/menu/{{ $menu->id }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                          </form>
                        </a>
                      </p>
                      @endif

                    </td>
                </tr>
                @endforeach
            </tbody>

          </table>
          <hr>
          {{ $menus->links() }}
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
