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
          <h2>Все пользователи
            <!-- CREATE -->
            <a href="/dashboard/user/create/">
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
                <th>Имя</th>
                <th>Дата создания</th>
                <th>E-mail</th>
                <th>Права</th>
                <th>Дата обновления</th>
                <th>Действия</th>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->title }}</td>
                    <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                      <p>
                      <!-- BAN / UNBAN -->
                      @if ($user->role->name=="banned")
                        <a class="btn btn-default btn-sm" href="/dashboard/user/ban/id/{{ $user->id }}"
                            onclick="event.preventDefault();
                                     document.getElementById('unban-form{{ $user->id }}').submit();">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>
                      @else


                        <!-- EDIT -->
                        <a href="/dashboard/user/edit/id/{{ $user->id }}">
                          <button type="button" class="btn btn-primary btn-sm">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                          </button>
                        </a>


                        <a class="btn btn-warning btn-sm" href="/dashboard/user/ban/id/{{ $user->id }}"
                            onclick="event.preventDefault();
                                     document.getElementById('ban-form{{ $user->id }}').submit();">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>


                      @endif

                          <form id="ban-form{{ $user->id }}" action="/dashboard/user/ban/id/{{ $user->id }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>

                          <form id="unban-form{{ $user->id }}" action="/dashboard/user/unban/id/{{ $user->id }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                      </p>
                    </td>
                </tr>
                @endforeach
            </tbody>

          </table>
          <hr>
          {{ $users->links() }}
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
