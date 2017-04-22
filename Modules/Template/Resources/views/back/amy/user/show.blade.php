@extends ('template::back.amy.layouts.main')
@section ('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все пользователи</div>
    </div>

    @if (session('result'))
     <div class="alert alert-info" role="alert">
       {{ session('result') }}
     </div>
    @endif

    @if (count($users) > 0)
    <table class="table table-striped">

        <thead>
            <th>Имя</th>
            <th>E-mail</th>
            <th>Права</th>
            <th>Дата обновления</th>
            <th></th>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->title }}</td>
                <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
                <td>
                  <p>
                  <!-- BAN / UNBAN -->
                  @if ($user->role->name=="banned")
                    <a class="btn btn-default btn-sm" href="/dashboard/user/ban/id/{{ $user->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('unban-form{{ $user->id }}').submit();">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </a>
                  @else


                    <!-- EDIT -->
                    <a href="/dashboard/user/edit/id/{{ $user->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>


                    <a class="btn btn-warning btn-sm" href="/dashboard/user/ban/id/{{ $user->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('ban-form{{ $user->id }}').submit();">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </a>


                  @endif

                    <!-- DELETE -->
                    <a href="/dashboard/user/delete/id/{{ $user->id }}">
                      <a class="btn btn-danger btn-sm" href="/dashboard/user/{{ $user->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $user->id }}').submit();">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </a>

                      <form id="destroy-form{{ $user->id }}" action="/dashboard/user/{{ $user->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                      </form>

                      <form id="ban-form{{ $user->id }}" action="/dashboard/user/ban/id/{{ $user->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>

                      <form id="unban-form{{ $user->id }}" action="/dashboard/user/unban/id/{{ $user->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }} @endif
</div>
@stop
