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

      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-avatar"><i class="fa fa-photo m-right-xs"></i> Изменить аватар</button>

      <div class="modal fade modal-avatar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="panel panel-default">
              <div class="panel-body">
                <form action="/profile/avatar" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-group">
                   <input type="file" name="photo" accept="image/*,image/jpeg">
                  </div>

                  <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-lock m-right-xs"></i> Изменить пароль</button>

      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="panel panel-default">
              <div class="panel-body">
                <form action="/profile/password" method="post">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="password">Новый пароль</label>
                    <input type="password" class="form-control" name="password" value="" required>
                  </div>

                  <div class="form-group">
                    <label for="password_confirmation">Подтвердите новый пароль</label>
                    <input type="password" class="form-control" name="password_confirmation" value="" required>
                  </div>

                  <button type="submit" class="btn btn-success">Изменить пароль</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />

    </div>
    <div class="col-md-9 col-sm-9 col-xs-12">

      <div class="profile_title">
        <div class="col-md-6">
          <h2>Последняя активность</h2>
        </div>
      </div>
      <br>
      <!-- start recent activity -->
      <ul class="messages">
        @foreach ($logs as $log)
        <li>
          <!-- <div class="message_date">
            <h3 class="date text-info">24</h3>
            <p class="month">May</p>
          </div> -->
          <div class="message_wrapper">
            <h4 class="heading">{{ $log->created_at->format('d/m/Y H:m:s') }}</h4>
            <blockquote class="message">{{ $log->body }}</blockquote>
            <br />
            <p class="url">
              <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
              <a href="#"><i class="fa fa-globe"></i> {{ $log->ip }} </a>
            </p>
          </div>
        </li>
        @endforeach
      </ul>
      {{ $logs->links() }}
      <!-- end recent activity -->

    </div>
  </div>
</div>
@stop
