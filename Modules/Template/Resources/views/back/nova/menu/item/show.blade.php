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
          <h2>Все пункты меню
            <!-- CREATE -->
            <a href="/dashboard/menu/item/create/{{ $id_menu }}">
              <button type="button" class="btn btn-primary btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
            </a>
          </h2>
          <div class="clearfix"></div>
        </div>

        <ol class="breadcrumb">
          <li><a href="/dashboard/menu">Меню</a></li>
          <li class="active">Пункты меню</li>
        </ol>

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <th>Заголовок</th>
                <th>Дата создания</th>
                <th>Описание</th>
                <th>URL</th>
                <th>Активен</th>
                <th>Поведение</th>
                <th>Доступ</th>
                <th>Дата обновления</th>
                <th>Действия</th>
            </thead>

            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>
                      @if ($item->required==1)
                      <i class="fa fa-get-pocket"></i>
                      @endif
                      {{ $item->title }}
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y h:m:s') }}</td>
                    <td>{{ str_limit($item->description, $limit = 100, $end = '...') }}</td>
                    <td>{{ $item->url }}</td>
                    <td>
                      @if ($item->activated==1) Активно @endif
                      @if ($item->activated==0) Неактивно @endif
                    </td>
                    <td>
                      @if ($item->target=='_blank') В новом окне @endif
                      @if ($item->target=='_self') В активном окне @endif
                    </td>
                    <td>{{ $item->role->title }}</td>
                    <td>{{ $item->updated_at->format('d/m/Y h:m:s') }}</td>
                    <td>

                      <p>
                        <!-- EDIT -->
                        <a href="/dashboard/menu/item/edit/id/{{ $item->id }}">
                          <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                          </button>
                        </a>

                      @if ($item->required==0)

                        <!-- DELETE -->
                        <a href="/dashboard/menu/item/{{ $item->id }}">
                          <a class="btn btn-danger btn-sm" href="/dashboard/menu/item/{{ $item->id }}"
                              onclick="event.preventDefault();
                                       document.getElementById('destroy-form{{ $item->id }}').submit();">
                                       <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>

                          <form id="destroy-form{{ $item->id }}" action="/dashboard/menu/item/{{ $item->id }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                          </form>
                        </a>
                      @endif
                      </p>

                    </td>
                </tr>
                @endforeach
            </tbody>

          </table>
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
