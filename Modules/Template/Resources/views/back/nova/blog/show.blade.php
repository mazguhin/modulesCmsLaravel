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
          <h2>Все блоги
            <!-- CREATE -->
            <a href="/dashboard/blog/create/">
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
        @includeIf ('template::back.nova.blog.info')

        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Название</th>
                <th>Создано</th>
                <th>Описание</th>
                <th>Модератор</th>
                <th>Адрес</th>
                <th>Изменено</th>
                <th>Действия</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->created_at->format('d/m/Y h:m:s') }}</td>
                    <td>{{ $blog->description }}</td>
                    <td>{{ $blog->moder->name }}</td>
                    <td>/blog/{{ $blog->slug }}</td>
                    <td>{{ $blog->updated_at->format('d/m/Y h:m:s') }}</td>
                    <td>

                    <p>
                      <a href="/blog/id/{{ $blog->id }}">
                        <button type="button" class="btn btn-default btn-sm">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                      </a>

                      <a href="/dashboard/blog/edit/id/{{ $blog->id }}">
                        <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                      </a>

                      <a class="btn btn-danger btn-sm" href="/dashboard/blog/{{ $blog->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $blog->id }}').submit();">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="destroy-form{{ $blog->id }}" action="/dashboard/blog/{{ $blog->id }}" method="POST" style="display: none;">
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
          {{ $blogs->links() }}
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
