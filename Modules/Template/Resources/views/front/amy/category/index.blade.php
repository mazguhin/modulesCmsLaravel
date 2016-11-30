@extends ('template::front.amy.layouts.main')

@section ('content')
@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
  Категории
</h1>
@foreach ($categories as $category)
<h2>
    <a href="/category/{{ $category->slug }}">{{ $category->name }}</a>
</h2>
<p><i class="fa fa-bullhorn" aria-hidden="true"></i> Создана {{ $category->created_at->format('d.m.Y') }}</p>
<p>{!! $category->description !!}</p>
<a class="btn btn-primary" href="/category/{{ $category->slug }}">Открыть категорию</a>
@if (RoleHelper::isAdmin())
  <a class="btn btn-default" href="/dashboard/category/edit/id/{{ $category->id }}">Редактировать</a>
  <a href="/dashboard/category/delete/id/{{ $category->id }}">
    <a class="btn btn-danger" href="/dashboard/category/{{ $category->id }}"
        onclick="event.preventDefault();
                 document.getElementById('destroy-form{{ $category->id }}').submit();">
        Удалить
    </a>

    <form id="destroy-form{{ $category->id }}" action="/dashboard/category/{{ $category->id }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
  </a>
<hr>
@endif
<hr>
@endforeach
{{ $categories->links() }}
@stop
