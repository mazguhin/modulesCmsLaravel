@extends ('template::back.amy.layouts.main') @section ('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все статьи</div>
    </div>

    @if (session('result'))
     <div class="alert alert-info" role="alert">
       {{ session('result') }}
     </div>
    @endif

    @if (count($articles) > 0)
    <table class="table table-striped">

        <thead>
            <th>Заголовок</th>
            <th>Описание</th>
            <th>Категория</th>
            <th>Доступ</th>
            <th>Создал</th>
            <th>Дата создания</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>
                  @if ($article->id==$startPageId)
                  <i class="fa fa-home" aria-hidden="true"></i>
                  @endif
                  {{ $article->title }}
                </td>
                <td>{{ $article->description }}</td>
                <td>{{ $article->category->name }}</td>
                <td>{{ $article->role->title }}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->created_at->format('d/m/Y h:m:s') }}</td>
                <td>{{ $article->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>

                  <p>
                    <!-- EDIT -->
                    <a href="/dashboard/article/edit/id/{{ $article->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>
                  </p>

                  @if ($article->id!=$startPageId)
                    <p>
                    <!-- setStartPage -->
                    <a href="/dashboard/setting/startpage/{{ $article->id }}">
                      <a class="btn btn-default btn-sm" href="/dashboard/setting/startpage/{{ $article->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('setStartPage-form{{ $article->id }}').submit();">
                                   <i class="fa fa-home" aria-hidden="true"></i>
                      </a>

                      <form id="setStartPage-form{{ $article->id }}" action="/dashboard/setting/startpage/{{ $article->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          <input type="hidden" name="type" value="article">
                      </form>
                    </a>
                  </p>

                  <p>
                    <!-- DELETE -->
                    <a href="/dashboard/article/delete/id/{{ $article->id }}">
                      <a class="btn btn-danger btn-sm" href="/dashboard/article/{{ $article->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $article->id }}').submit();">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="destroy-form{{ $article->id }}" action="/dashboard/article/{{ $article->id }}" method="POST" style="display: none;">
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
    {{ $articles->links() }}
    @endif
</div>
@stop
