@extends ('template::back.nova.layouts.main')

@section ('content')
 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Редактирование блока</div>
   </div>

  @if (session('result'))
   <div class="alert alert-info" role="alert">
     {{ session('result') }}
   </div>
  @endif

  @include ('template::back.nova.block.errors')

  <ol class="breadcrumb">
    <li><a href="/dashboard/block">Блоки</a></li>
    <li class="active">Редактирование блока</li>
  </ol>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/block/edit/{{ $block->id }}">
       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" value="{{ $block->description }}" class="form-control" id="description" name="description" placeholder="Введите описание">
        <p class="help-block">Описание может видеть только администратор</p>
       </div>

       <div class="form-group">
         <label for="role">Доступ*</label>
         <select class="form-control" id="role" name="role">
           @foreach ($roles as $role)
           <option value="{{ $role->id }}"
             @if ($role->id==$block->role->id) selected @endif
           >{{ $role->title }}</option>
           @endforeach
          </select>
       </div>

       <div class="form-group">
         <textarea id="editor" name="editor">{{ $block->body }}</textarea>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Применить</button>
      </form>
   </div>
 </div>


 <script src="/plugins/ckeditor/ckeditor.js"></script>
 <script type="text/javascript">
    CKEDITOR.replace('editor');
  </script>
@stop
