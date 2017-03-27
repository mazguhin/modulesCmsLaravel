@extends ('template::back.amy.layouts.main') @section ('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все категории</div>
    </div>

    @if (session('result'))
     <div class="alert alert-info" role="alert">
       {{ session('result') }}
     </div>
    @endif

    @if (count($staffCategories) > 0)
    <table class="table table-striped">

        <thead>
            <th>Название</th>
            <th>Описание</th>
            <th>Создал</th>
            <th>Дата создания</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($staffCategories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->user->name }}</td>
                <td>{{ $category->created_at->format('d/m/Y h:m:s') }}</td>
                <td>{{ $category->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>

                  <p>
                  <a href="/dashboard/staff/category/edit/id/{{ $category->id }}">
                    <button type="button" class="btn btn-primary btn-sm">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                  </a>
                </p>

                <p>
                  <a href="/dashboard/staff/category/delete/id/{{ $category->id }}">
                    <a class="btn btn-danger btn-sm" href="/dashboard/staff/category/{{ $category->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('destroy-form{{ $category->id }}').submit();">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>

                    <form id="destroy-form{{ $category->id }}" action="/dashboard/staff/category/{{ $category->id }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                  </a>
                </p>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $staffCategories->links() }} @endif
</div>
@stop
