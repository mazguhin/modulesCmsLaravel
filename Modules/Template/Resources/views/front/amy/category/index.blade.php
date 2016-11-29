@extends ('template::front.amy.layouts.main')

@section ('content')

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
<hr>
@endforeach
{{ $categories->links() }}
@stop
