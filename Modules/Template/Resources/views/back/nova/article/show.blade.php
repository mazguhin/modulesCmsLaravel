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
            <h2>Все статьи
              <!-- CREATE -->
              <a href="/dashboard/article/create/">
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
          @includeIf ('template::back.nova.article.info')

          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Заголовок</th>
                  <th>Создано</th>
                  <th>Описание</th>
                  <th>Доступ</th>
                  <th>Создал</th>
                  <th>Категория</th>
                  <th>Изменено</th>
                  <th>Действия</th>
                </tr>
              </thead>

              <tbody>
                  @foreach ($articles as $article)
                  <tr>
                      <td>
                        @if ($article->id==$startPageId)
                        <i class="fa fa-home" aria-hidden="true"></i>
                        @endif

                        {{ str_limit($article->title, $limit = 100, $end = '...') }}

                      </td>
                      <td>{{ $article->created_at->format('d/m/Y h:m:s') }}</td>
                      <td>{{ $article->description }}</td>
                      <td>{{ $article->role->title }}</td>
                      <td>{{ $article->user->name }}</td>
                      <td>{{ $article->category->name }}</td>
                      <td>{{ $article->updated_at->format('d/m/Y h:m:s') }}</td>
                      <td>
                        <p>
                        <?php $type = (explode("-",$article->category->slug)) ?>
                        @if (count($type)==3 && $type[0]=='clubcode' && ($type[2]=='info' || $type[2]=='news'))
                          <a href="/club/id/{{$type[1]}}/{{$type[2]}}/id/{{$article->id}}">
                            <button type="button" class="btn btn-default btn-sm">
                              <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                          </a>
                        @else
                          <a href="/article/id/{{ $article->id }}">
                            <button type="button" class="btn btn-default btn-sm">
                              <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                          </a>
                        @endif

                        @if ($article->category->club==false)

                          <!-- EDIT -->
                          <a href="/dashboard/article/edit/id/{{ $article->id }}">
                            <button type="button" class="btn btn-primary btn-sm">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                          </a>


                        @if ($article->id!=$startPageId)

                          <!-- setStartPage -->
                          <a href="/dashboard/setting/startpage/{{ $article->id }}">
                            <a class="btn btn-default btn-sm" href="/dashboard/setting/startpage/{{ $article->id }}"
                                onclick="event.preventDefault();
                                         document.getElementById('setStartPage-form{{ $article->id }}').submit();">
                                         <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                          </a>

                          <!-- DELETE -->
                          <a class="btn btn-danger btn-sm" href="/dashboard/article/{{ $article->id }}"
                              onclick="event.preventDefault();
                                       document.getElementById('destroy-form{{ $article->id }}').submit();">
                                       <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>

                          <form id="setStartPage-form{{ $article->id }}" action="/dashboard/setting/startpage/{{ $article->id }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                              <input type="hidden" name="type" value="article">
                          </form>

                            <form id="destroy-form{{ $article->id }}" action="/dashboard/article/{{ $article->id }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>


                      @endif
                        </p>
                      @endif

                      </td>
                  </tr>
                  @endforeach
              </tbody>

            </table>
            <hr>
            {{ $articles->links() }}
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
