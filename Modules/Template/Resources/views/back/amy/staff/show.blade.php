@extends ('template::back.amy.layouts.main') @section ('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все сотрудники
          <!-- CREATE -->
          <a href="/dashboard/staff/create/">
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

    @if (count($staffs) > 0)
    <table class="table table-striped">

        <thead>
            <th>ФИО</th>
            <th>Категория</th>
            <th>Создал</th>
            <th>Дата создания</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($staffs as $staff)
            <tr>
                <td>{{ $staff->fullName }}</td>
                <td>
                  <ul>
                    @foreach ($staff->categories as $cat)
                      <li>{{ $cat->name }}</li>
                    @endforeach
                  </ul>
                </td>
                <td>{{ $staff->user->name }}</td>
                <td>{{ $staff->created_at->format('d/m/Y h:m:s') }}</td>
                <td>{{ $staff->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>

                  <p>
                    <!-- EDIT -->
                    <a href="/dashboard/staff/edit/id/{{ $staff->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>
                
                    <!-- DELETE -->
                    <a href="/dashboard/staff/delete/id/{{ $staff->id }}">
                      <a class="btn btn-danger btn-sm" href="/dashboard/staff/{{ $staff->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $staff->id }}').submit();">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="destroy-form{{ $staff->id }}" action="/dashboard/staff/{{ $staff->id }}" method="POST" style="display: none;">
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
    {{ $staffs->links() }}
    @endif
</div>
@stop
