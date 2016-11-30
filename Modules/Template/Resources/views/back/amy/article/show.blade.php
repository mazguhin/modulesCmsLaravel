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
                <td>{{ $article->title }}</td>
                <td>{{ $article->description }}</td>
                <td>{{ $article->category->name }}</td>
                <!-- TODO: исправить права и роли на нормальное отображение -->
                <td>{{ $article->permission }}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->created_at->format('d/m/Y h:m:s') }}</td>
                <td>{{ $article->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>
                  <a href="/dashboard/article/edit/id/{{ $article->id }}">
                    <button type="button" class="btn btn-primary btn-sm">Редактировать</button>
                  </a>
                  <a href="/dashboard/article/delete/id/{{ $article->id }}">
                    <a class="btn btn-danger btn-sm" href="/dashboard/article/{{ $article->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('destroy-form{{ $article->id }}').submit();">
                        Удалить
                    </a>

                    <form id="destroy-form{{ $article->id }}" action="/dashboard/article/{{ $article->id }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                  </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $articles->links() }} @endif
</div>
@stop
