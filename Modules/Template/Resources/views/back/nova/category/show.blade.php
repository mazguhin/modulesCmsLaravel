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
          <h2>Все категории
            <!-- CREATE -->
            <a href="/dashboard/category/create/">
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
                <th>Название</th>
                <th>Дата создания</th>
                <th>Описание</th>
                <th>Доступ</th>
                <th>Создал</th>
                <th>Дата обновления</th>
                <th>Действия</th>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>
                      {{ str_limit($category->name, $limit = 100, $end = '...') }}
                      @if ($category->id==$startPageId)
                      <i class="fa fa-home" aria-hidden="true"></i>
                      @endif
                    </td>
                    <td>{{ $category->created_at->format('d/m/Y h:m:s') }}</td>
                    <td>{{ str_limit($category->description, $limit = 100, $end = '...') }}</td>
                    <td>{{ $category->role->title }}</td>
                    <td>{{ $category->user->name }}</td>
                    <td>{{ $category->updated_at->format('d/m/Y h:m:s') }}</td>
                    <td>

                    <p>
                      <a href="/dashboard/category/edit/id/{{ $category->id }}">
                        <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                      </a>


                      @if ($category->id!=$startPageId)

                      <!-- setStartPage -->
                      <a class="btn btn-default btn-sm" href="/dashboard/setting/startpage/{{ $category->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('setStartPage-form{{ $category->id }}').submit();">
                                   <i class="fa fa-home" aria-hidden="true"></i>
                      </a>

                      <a class="btn btn-danger btn-sm" href="/dashboard/category/{{ $category->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $category->id }}').submit();">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="destroy-form{{ $category->id }}" action="/dashboard/category/{{ $category->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                      </form>

                      <form id="setStartPage-form{{ $category->id }}" action="/dashboard/setting/startpage/{{ $category->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          <input type="hidden" name="type" value="category">
                      </form>
                    @endif
                  </p>
                  </td>
                </tr>
                @endforeach
            </tbody>

          </table>
          <hr>
          {{ $categories->links() }}
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
