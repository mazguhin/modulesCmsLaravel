@extends ('template::front.nova.layouts.main')

@section ('content')
@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h2>Категории сотрудников</h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">

    <table class="table table-striped projects">
      <thead>
        <tr>
          <th style="width: 1%">#</th>
          <th >Наименование</th>
          <th>Преподаватели</th>
          <th>Действия</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
          <td>#</td>
          <td>
            <a><a href="/staff/category/{{ $category->slug }}">{{ $category->name }}</a></a>
            <br />
            <small>Создана {{ $category->created_at->format('d.m.Y') }}</small>
          </td>
          <td>
            <ul class="list-inline">
              @foreach ($category->staffs as $staff)
              <li>
                <img src="{{ $staff->getPhoto() }}" class="avatar" alt="{{ $staff->fullName }}">
              </li>
              @break ($loop->iteration==4)
              @endforeach
            </ul>
          </td>
          <td>
            <a href="/staff/category/{{ $category->slug }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
            @if (RoleHelper::isAdmin())
              <a href="/dashboard/staff/category/edit/id/{{ $category->id }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                <a class="btn btn-danger btn-sm" href="/dashboard/staff/category/{{ $category->id }}"
                    onclick="event.preventDefault();
                             document.getElementById('destroy-form{{ $category->id }}').submit();">
                    <i class="fa fa-trash-o"></i>
                  </a>

                <form id="destroy-form{{ $category->id }}" action="/dashboard/staff/category/{{ $category->id }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  {{ $categories->links() }}

  </div>
</div>

@stop
