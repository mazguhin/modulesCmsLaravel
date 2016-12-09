<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amy / Template</title>

    <!-- Styles -->
    <link href="{{ elixir('/css/app.css') }}" rel="stylesheet">
    <link href="{{ elixir('/css/front/amy/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
      @includeIf ('template::front.amy.layouts.header')
      <div class="container">

          <div class="row">

              <!-- Blog Entries Column -->
              <div class="col-md-8">
                  @yield('content')
              </div>

              <!-- Blog Sidebar Widgets Column -->
              <div class="col-md-4">

                  <!-- Blog Search Well -->
                  @includeIf('template::front.amy.search.show')

                  <!-- Categories Well -->
                  @includeIf ('template::front.amy.category.list', ['categories'=>CategoryHelper::getAll()])

                  <!-- Side Widget Well -->
                  @includeIf('template::front.amy.widget.show')

              </div>

          </div>

          <hr>

          <!-- Footer -->
          <footer>

          </footer>

      </div>

    </div>

    <!-- Scripts -->

    <script src="{{ elixir('/js/app.js') }}"></script>
</body>
</html>
