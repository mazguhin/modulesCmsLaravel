@extends ('blog::standard.layouts.main')

@section ('content')

        <div class="col-sm-8 blog-main">
          <h1>
            {{ $category->title }}

            @if (RoleHelper::validatePermissionForBlog($blog))
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCategory">
              <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
            </a>

            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCategory">
              <i class="fa fa-trash" aria-hidden="true"></i> Удалить
            </a>
            @endif

          </h1>
          <hr>
          @foreach ($articles as $article)
          <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">
              {{ $article->created_at->format('d/m/Y H:m:s') }} <a href="/profile/{{ $article->user->id }}">{{ $article->user->name }}</a>
            </p>
            <p>{!! str_limit($article->body, $limit = 800, $end = '...') !!}</p>
            <p><a href="/blog/id/{{ $blog->id }}/article/{{ $article->id }}" class="btn btn-default">Читать далее...</a></p>
          </div>
          <hr>
          @endforeach
        </div>

        @if (RoleHelper::validatePermissionForBlog($blog))
        <!-- Modal [editCategory] -->
        <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="editCategoryLabel">Редактировать категорию</h4>
          </div>
          <div class="modal-body">
            <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/category/edit/{{ $category->id }}">
              <div class="form-group">
               <label for="title">Наименование</label>
               <input type="text" class="form-control" id="title" name="title" value="{{ $category->title }}" placeholder="Введите наименование категории" required>
              </div>

              {{ csrf_field() }}
              <button type="submit" class="btn btn-success">Применить</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </form>
          </div>
        </div>
        </div>
        </div>

        <!-- Modal [deleteCategory] -->
        <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="deleteCategoryLabel">Удалить категорию</h4>
          </div>
          <div class="modal-body">
            <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/category/{{ $category->id }}">
              <h3>Вы действительно хотите удалить данную категорию?</h3>
              <p>Все статьи данной категории автоматически будут удалены.</p>

              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-danger">Удалить</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </form>
          </div>
        </div>
        </div>
        </div>
        @endif
        
@stop
