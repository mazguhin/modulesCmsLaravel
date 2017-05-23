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
          <h2>Все клубы
            <!-- CREATE -->
            <a href="/dashboard/club/create/">
              <button type="button" class="btn btn-primary btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
            </a>
          </h2>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Название</th>
                <th>Создано</th>
                <th>Описание</th>
                <th>Модераторы</th>
                <th>Тип</th>
                <th>Изменено</th>
                <th>Действия</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($clubs as $club)
                <tr>
                    <td>{{ $club->name }}</td>
                    <td>{{ $club->created_at->format('d/m/Y h:m:s') }}</td>
                    <td>{{ $club->description }}</td>
                    <td>
                      @foreach ($club->moders as $moder)
                        <p>{{ $moder->name }}</p>
                      @endforeach
                    </td>
                    <td>
                      @if ($club->pay==false) Бесплатный @else Платный @endif
                    </td>
                    <td>{{ $club->updated_at->format('d/m/Y h:m:s') }}</td>
                    <td>

                    <p>
                      <a href="/dashboard/club/edit/id/{{ $club->id }}">
                        <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                      </a>

                      <a class="btn btn-danger btn-sm" href="/dashboard/club/{{ $club->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $club->id }}').submit();">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="destroy-form{{ $club->id }}" action="/dashboard/club/{{ $club->id }}" method="POST" style="display: none;">
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
          {{ $clubs->links() }}
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
