@extends ('template::back.amy.layouts.main') @section ('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все меню
          <!-- CREATE -->
          <a href="/dashboard/menu/create/">
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

    @if (count($menus) > 0)
    <table class="table table-striped">

        <thead>
            <th>Заголовок</th>
            <th>Описание</th>
            <th>Активно</th>
            <th>Доступ</th>
            <th>URL</th>

            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($menus as $menu)
            <tr>
                <td><i class="fa {{ $menu->icon }}"></i> {{ $menu->title }}</td>
                <td>{{ $menu->description }}</td>
                <td>
                  @if ($menu->activated==1) Активно @endif
                  @if ($menu->activated==0) Неактивно @endif
                </td>
                <td>{{ $menu->access->title }}</td>
                <td>{{ $menu->url }}</td>
                <td>

                  <p>
                    <!-- EDIT -->
                    <a href="/dashboard/menu/edit/id/{{ $menu->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>


                  @if (empty($menu->url))

                    <!-- edit items menu -->
                    <a href="/dashboard/menu/item/id/{{ $menu->id }}">
                      <button type="button" class="btn btn-default btn-sm">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                      </button>
                    </a>

                  @endif

                    <!-- DELETE -->
                    <a href="/dashboard/menu/delete/id/{{ $menu->id }}">
                      <a class="btn btn-danger btn-sm" href="/dashboard/menu/{{ $menu->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $menu->id }}').submit();">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="destroy-form{{ $menu->id }}" action="/dashboard/menu/{{ $menu->id }}" method="POST" style="display: none;">
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
    {{ $menus->links() }}
    @endif
</div>
@stop
