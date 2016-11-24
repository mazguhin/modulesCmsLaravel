@extends ('template::front.amy.layouts.main')

@section ('content')

@foreach ($articles as $article)
<div class="panel panel-default col-sm-5 col-sm-offset-3">
  <div class="panel-heading">
    <div class="panel-title">{{ $article->title }}</div>
  </div>
  <div class="panel-body">{{ $article->body }}</div>
</div>
@endforeach

@stop
