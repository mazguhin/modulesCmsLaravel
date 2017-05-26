<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Вход / Регистрация</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">

    @if (count($errors) > 0)
      <!-- Список ошибок формы -->
      <div class="alert alert-danger text-center">
        <strong>Упс! Что-то пошло не так!</strong>

        <br><br>

          @foreach ($errors->all() as $error)
            @if ($error=='auth.failed')
              Ошибка авторизации
              @continue
            @endif
            <p>{{ $error }}</p>
          @endforeach

      </div>
    @endif

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form role="form" method="POST" action="{{ url('/login') }}">
              <h1>Вход</h1>

              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Пароль</label>
                <input id="password" type="password" class="form-control" name="password" required>
              </div>

              <div class="form-group">
                <div class="checkbox">
                  <label><input type="checkbox" name="remember"> Запомнить меня</label>
                </div>
              </div>

              <div>
                <button class="btn btn-default submit" type="submit">Войти</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Нет аккаунта?
                  <a href="#signup" class="to_register"> <b>Зарегистрируйтесь</b> </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <a href="/"><h1><i class="fa fa-home"></i> Smans</h1></a>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form role="form" method="POST" action="{{ url('/register') }}">
              <h1>Регистрация</h1>
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Имя</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Пароль</label>
                <input id="password" type="password" class="form-control" name="password" required>
              </div>

              <div class="form-group">
                <label for="password-confirm" class="control-label">Подтвердить пароль</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>

              <div>
                <button class="btn btn-default submit" type="submit">Войти</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Уже зарегистрированы?
                  <a href="#signin" class="to_register"> <b>Войдите в свой аккаунт</b> </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <a href="/"><h1><i class="fa fa-home"></i> Smans</h1></a>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
