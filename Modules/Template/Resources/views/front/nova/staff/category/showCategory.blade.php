@extends ('template::front.nova.layouts.main')

@section ('content')
@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
    {{ $category->name }}

    @if (RoleHelper::isAdmin())
    <a class="btn btn-primary btn-sm" href="/dashboard/staff/category/edit/id/{{ $category->id }}">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>

    <a href="/dashboard/staff/category/delete/id/{{ $category->id }}">
      <a class="btn btn-danger btn-sm" href="/dashboard/staff/category/{{ $category->id }}"
          onclick="event.preventDefault();
                   document.getElementById('destroy-form').submit();">
          <i class="fa fa-trash" aria-hidden="true"></i>
      </a>

      <form id="destroy-form" action="/dashboard/staff/category/{{ $category->id }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
      </form>
    </a>
    @endif
</h1>

@foreach ($staffs as $staff)
  <div class="staffs">
    <a href="/staff/{{ $staff->slug }}">
      @if ($staff->photo=="")
        <img src="/images/user.png" alt="Фото">
      @else
        <img src="{{ Storage::url($staff->photo) }}" class="img-responsive" alt="Фото">
      @endif
      <h2>{{ $staff->fullName }}</h2>
      {{ $staff->position }}
    </a>
  </div>

<hr>
@endforeach
{{ $staffs->links() }}
@stop

@section('localcss')
  .staffs {
    text-align:center;
  }

  .staffs .img-responsive {
    margin: 0 auto;
  }
@stop
