@extends ('blog::standard.layouts.main')

@section ('content')

        <div class="col-sm-8 blog-main">
          <div class="blog-post">
            <h2 class="blog-post-title">
              {{ $article->title }}

              @if (RoleHelper::validatePermissionForBlog($blog))
              <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editArticle">
                <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
              </a>

              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteArticle">
                <i class="fa fa-trash" aria-hidden="true"></i> Удалить
              </a>
              @endif
            </h2>
            <p class="blog-post-meta">
              {{ $article->created_at->format('d/m/Y H:m:s') }} <a href="/profile/{{ $article->user->id }}">{{ $article->user->name }}</a>
              <br>
              Категория: <a href="/blog/id/{{ $blog->id }}/category/{{ $article->category->id }}">{{ $article->category->title }}</a>
            </p>
            <p>{!! $article->body !!}</p>
          </div>
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

        <!-- Modal [editArticle] -->
        <div class="modal fade" id="editArticle" tabindex="-1" role="dialog" aria-labelledby="editArticleLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="editArticleLabel">Редактировать статью</h4>
          </div>
          <div class="modal-body">
            <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/article/edit/{{ $article->id }}">

              <div class="form-group">
               <label for="title">Заголовок*</label>
               <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" placeholder="Введите наименование категории" required>
              </div>

              <div class="form-group">
                <label for="category">Категория*</label>
                <select class="form-control" id="category" name="category">
                   @foreach ($categories as $category)
                     <option value="{{ $category->id }}"
                       @if ($article->category->id == $category->id)
                       selected
                       @endif
                       >{{ $category->title }}</option>
                   @endforeach
                 </select>
              </div>

              <div class="form-group">
                <textarea id="editorEditArticle" name="body">{!! $article->body !!}</textarea>
              </div>

              {{ csrf_field() }}
              <button type="submit" class="btn btn-success">Применить</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </form>
          </div>
        </div>
        </div>
        </div>

        <!-- Modal [deleteArticle] -->
        <div class="modal fade" id="deleteArticle" tabindex="-1" role="dialog" aria-labelledby="deleteArticleLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="deleteArticleLabel">Удалить статью</h4>
          </div>
          <div class="modal-body">
            <form role="form" method="POST" action="/blog/id/{{ $blog->id }}/article/{{ $article->id }}">
              <h3>Вы действительно хотите удалить данную статью?</h3>

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

@section ('localjs')
CKEDITOR.replace('editorEditArticle');
@stop
