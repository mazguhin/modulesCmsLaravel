@extends ('template::back.amy.layouts.main')

@section ('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все пункты меню
          <!-- CREATE -->
          <a href="/dashboard/menu/item/create/{{ $id_menu }}">
            <button type="button" class="btn btn-primary btn-sm">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
          </a>
        </div>
    </div>

    @if (session('result'))
     <div class="alert alert-info" role="alert">
       {{ session('result') }}
     </div>
    @endif

    @if (count($items) > 0)
    <table class="table table-striped">
        <thead>
            <th>Заголовок</th>
            <th>Описание</th>
            <th>URL</th>
            <th>Активен</th>
            <th>Поведение</th>
            <th>Доступ</th>
            <th>Дата создания</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
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
                <td>{{ $item->created_at->format('d/m/Y h:m:s') }}</td>
                <td>{{ $item->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>

                  <p>
                    <!-- EDIT -->
                    <a href="/dashboard/menu/item/edit/id/{{ $item->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>
                  </p>

                  <p>
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
                  </p>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@stop
