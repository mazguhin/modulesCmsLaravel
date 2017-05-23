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
          <h2>Все сотрудники
            <!-- CREATE -->
            <a href="/dashboard/staff/create/">
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
                <th>ФИО</th>
                <th>Дата создания</th>
                <th>Категория</th>
                <th>Занимаемая должность</th>
                <th>Преподаваемые дисциплины</th>
                <th>Ученая степень</th>
                <th>Ученое звание</th>
                <th>Направления подготовки</th>
                <th>Данные о повышении квалификации</th>
                <th>Общий стаж работы</th>
                <th>Стаж работы по специальности</th>
                <th>Создал</th>
                <th>Дата обновления</th>
                <th>Действия</th>
            </thead>

            <tbody>
                @foreach ($staffs as $staff)
                <tr>
                    <td>{{ $staff->fullName }}</td>
                    <td>{{ $staff->created_at->format('d/m/Y h:m:s') }}</td>
                    <td>
                      <ul>
                        @foreach ($staff->categories as $cat)
                          <li>{{ $cat->name }}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>{{ $staff->position }}</td>
                    <td>{{ $staff->disciplines }}</td>
                    <td>{{ $staff->academicDegree }}</td>
                    <td>{{ $staff->academicTitle }}</td>
                    <td>{{ $staff->specialty }}</td>
                    <td>{{ $staff->training }}</td>
                    <td>{{ $staff->generalExperience }}</td>
                    <td>{{ $staff->specialtyExperience }}</td>
                    <td>{{ $staff->user->name }}</td>
                    <td>{{ $staff->updated_at->format('d/m/Y h:m:s') }}</td>
                    <td>

                      <p>
                        <!-- EDIT -->
                        <a href="/dashboard/staff/edit/id/{{ $staff->id }}">
                          <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                          </button>
                        </a>

                        <!-- DELETE -->
                        <a class="btn btn-danger btn-sm" href="/dashboard/staff/{{ $staff->id }}"
                            onclick="event.preventDefault();
                                     document.getElementById('destroy-form{{ $staff->id }}').submit();">
                                     <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>

                        <form id="destroy-form{{ $staff->id }}" action="/dashboard/staff/{{ $staff->id }}" method="POST" style="display: none;">
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
          {{ $staffs->links() }}
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
