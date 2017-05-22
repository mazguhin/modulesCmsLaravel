@extends ('template::back.nova.layouts.main')

@section ('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все блоки
          <!-- CREATE -->
          <a href="/dashboard/block/create/">
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

    @if (count($blocks) > 0)
    <table class="table table-striped">

        <thead>
            <th>ID</th>
            <th>Описание</th>
            <th>Доступ</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($blocks as $block)
            <tr>
                <td>{{ $block->id }}</td>
                <td>{{ $block->description }}</td>
                <td>{{ $block->role->title }}</td>
                <td>{{ $block->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>
                  <p>
                    <!-- EDIT -->
                    <a href="/dashboard/block/edit/{{ $block->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>

                    <!-- DELETE -->
                    <a class="btn btn-danger btn-sm" href="/dashboard/block/{{ $block->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('destroy-form{{ $block->id }}').submit();">
                                 <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>

                    <form id="destroy-form{{ $block->id }}" action="/dashboard/block/{{ $block->id }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                  </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $blocks->links() }}
    @endif
</div>
@stop
