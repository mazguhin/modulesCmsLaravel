@extends ('template::front.nova.layouts.main')

@section ('content')
@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
  Категории сотрудников
</h1>
@foreach ($categories as $category)
<h2>
    <a href="/staff/category/{{ $category->slug }}">{{ $category->name }}</a>
    @if (RoleHelper::isAdmin())
      <a class="btn btn-primary btn-sm" href="/dashboard/staff/category/edit/id/{{ $category->id }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
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
    @endif
</h2>
<p><i class="fa fa-bullhorn" aria-hidden="true"></i> Создана {{ $category->created_at->format('d.m.Y') }}</p>
<p>{!! $category->description !!}</p>
<hr>
@endforeach
{{ $categories->links() }}
@stop
