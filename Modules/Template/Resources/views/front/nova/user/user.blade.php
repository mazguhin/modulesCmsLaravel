@extends ('template::front.nova.layouts.main')

@section ('content')

@if (session('result'))
<div class="alert alert-info" role="alert">
  {{ session('result') }}
</div>
@endif

@include ('template::front.nova.user.errors')

<div class="x_panel">
  <div class="x_title">
    <h2>Профиль</h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
      <div class="profile_img">
        <div id="crop-avatar">
          <!-- Current avatar -->
          <img class="img-responsive avatar-view" src="{{ $user->getPhoto() }}" alt="Avatar" title="Change the avatar">
        </div>
      </div>
      <h3>{{ $user->name }}</h3>

      <ul class="list-unstyled user_data">
        <li>
          <i class="fa fa-briefcase user-profile-icon"></i> {{ $user->role->title }}
        </li>
        <li>
          <i class="fa fa-envelope user-profile-icon"></i> {{ $user->email }}
        </li>
      </ul>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="row top_tiles">
        @if ($role == 'administrator' || $role == 'moderator')
        <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-file-text"></i></div>
            <div class="count">{{ $articles }}</div>
            <h3>Статьи</h3>
            <p>Добавлено данным пользователем</p>
          </div>
        </div>
        @endif

        <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-comments-o"></i></div>
            <div class="count">{{ $faq }}</div>
            @if ($role=='administrator')
              <h3>Ответов</h3>
              <p>Дано на вопросы пользователей</p>
            @else
              <h3>Вопросов</h3>
              <p>Было задано пользователем</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
