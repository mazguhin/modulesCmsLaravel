@extends ('template::templates.'.Settings::get('activeTemplate').'.layouts.main')

@section ('content')
<div class="panel panel-default col-sm-5 col-sm-offset-3">
  <div class="panel-heading">
    <div class="panel-title">{{ $article->title }}</div>
  </div>
  <div class="panel-body">{{ $article->body }}</div>
</div>
@stop