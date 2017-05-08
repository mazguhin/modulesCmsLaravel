@extends ('template::front.nova.layouts.main')

@section ('content')
<div class="jumbotron">
    <h1>Упс!</h1>
    <p>У вас нет прав на просмотр данной страницы</p>
    <p><a class="btn btn-primary btn-lg" href="{{ URL::previous() }}" role="button">Вернуться назад</a></p>
</div>
@stop
