<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $blog->title }}</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/blog/standard/css/blog.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="/blog/{{ $blog->slug }}">Главная блога</a>
          <a class="blog-nav-item" href="/">Главная школы</a>

          @if (Auth::guest())
          <a href="{{ url('/login#signin') }}" class="blog-nav-item">Войти</a>
          <a href="{{ url('/login#signup') }}" class="blog-nav-item">Регистрация</a>
          @else
          <a class="blog-nav-item" href="{{ url('/logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Выход
          </a>
          @endif

          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </nav>
      </div>
    </div>

    <div class="container">
      <div class="row">

        <div class="blog-header">

          @if (session('result'))
           <div class="alert alert-info" role="alert">
             {{ session('result') }}
           </div>
          @endif

          @include ('blog::standard.errors')

          <h1 class="blog-title">{{ $blog->title }}
            @if (RoleHelper::validatePermissionForBlog($blog))
            <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editTitle">
              <i class="fa fa-pencil" aria-hidden="true"></i> Изменить
            </a>
            @endif
          </h1>
          <p class="lead blog-description">{{ $blog->description }}</p>
        </div>


        @yield('content')

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module text-center">
            @if (RoleHelper::validatePermissionForBlog($blog))
            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#createArticle">
              <i class="fa fa-plus" aria-hidden="true"></i> Добавить статью
            </a>
            @endif
          </div>

          <div class="sidebar-module sidebar-module-inset">
            <h4>Об авторе
              @if (RoleHelper::validatePermissionForBlog($blog))
              <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editAbout">
                <i class="fa fa-pencil" aria-hidden="true"></i> Изменить
              </a>
              @endif
            </h4>
            <p>{!! $blog->about !!}</p>
          </div>

          <div class="sidebar-module">
            <h4>Категории
              @if (RoleHelper::validatePermissionForBlog($blog))
              <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createCategory">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
              </a>
              @endif
            </h4>
            <ol class="list-unstyled">
              @foreach ($categories as $category)
              <li><a href="/blog/id/{{ $blog->id }}/category/{{ $category->id }}">{{ $category->title }}</a></li>
              @endforeach
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <div class="blog-footer">
      <p>Подвал</p>
      <p>
        <a href="#">Наверх</a>
      </p>
    </div>

    @if (RoleHelper::validatePermissionForBlog($blog))
    <!-- Modal [createArticle] -->
    <div class="modal fade" id="createArticle" tabindex="-1" role="dialog" aria-labelledby="createArticleLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createArticleLabel">Создать статью</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/article/create">

          <div class="form-group">
           <label for="title">Заголовок*</label>
           <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Введите наименование категории" required>
          </div>

          <div class="form-group">
            <label for="category">Категория*</label>
            <select class="form-control" id="category" name="category">
               @foreach ($categories as $category)
                 <option value="{{ $category->id }}">{{ $category->title }}</option>
               @endforeach
             </select>
          </div>

          <div class="form-group">
            <textarea id="editorNewArticle" name="body">{!! old('body') !!}</textarea>
          </div>

          {{ csrf_field() }}
          <button type="submit" class="btn btn-success">Создать</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </form>
      </div>
    </div>
    </div>
    </div>

    <!-- Modal [createCategory] -->
    <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createCategoryLabel">Создать категорию</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/category/create">
          <div class="form-group">
           <label for="title">Наименование</label>
           <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Введите наименование категории" required>
          </div>

          {{ csrf_field() }}
          <button type="submit" class="btn btn-success">Создать</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </form>
      </div>
    </div>
    </div>
    </div>

    <!-- Modal [editAbout] -->
    <div class="modal fade" id="editAbout" tabindex="-1" role="dialog" aria-labelledby="editAboutLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editAboutLabel">Изменить информацию</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/about/edit">
          <div class="form-group">
            <textarea id="editorAbout" name="about">{!! $blog->about !!}</textarea>
          </div>

          {{ csrf_field() }}
          <button type="submit" class="btn btn-success">Применить</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </form>
      </div>
    </div>
    </div>
    </div>

    <!-- Modal [editTitle] -->
    <div class="modal fade" id="editTitle" tabindex="-1" role="dialog" aria-labelledby="editTitleLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editTitleLabel">Изменить информацию</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/title/edit">
          <div class="form-group">
           <label for="title">Наименование блога</label>
           <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" placeholder="Введите наименование блога" required>
          </div>

          <div class="form-group">
           <label for="description">Описание блога</label>
           <input type="text" class="form-control" id="description" name="description" value="{{ $blog->description }}" placeholder="Введите описание блога" required>
          </div>

          {{ csrf_field() }}
          <button type="submit" class="btn btn-success">Применить</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </form>
      </div>
    </div>
    </div>
    </div>
    @endif

    <!-- jQuery -->
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
       CKEDITOR.replace('editorNewArticle');
       CKEDITOR.replace('editorAbout');
    </script>

    <script type="text/javascript">
      @yield ('localjs')
    </script>
  </body>
</html>
