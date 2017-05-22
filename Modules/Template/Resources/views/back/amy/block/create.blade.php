@extends ('template::back.amy.layouts.main')

@section ('content')
 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Создать новый блок</div>
   </div>

   <ol class="breadcrumb">
     <li><a href="/dashboard/block">Блоки</a></li>
     <li class="active">Создание блока</li>
   </ol>

  @if (session('result'))
   <div class="alert alert-info" role="alert">
     {{ session('result') }}
   </div>
  @endif

  @include ('template::back.amy.block.errors')

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/block/create">
       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" class="form-control" id="description" value="{{ old('description') }}" name="description" placeholder="Введите описание">
        <p class="help-block">Описание может видеть только администратор</p>
       </div>

       <div class="form-group">
         <label for="role">Доступ*</label>
         <select class="form-control" id="role" name="role">
           @foreach ($roles as $role)
             <option value="{{ $role->id }}">{{ $role->title }}</option>
           @endforeach
          </select>
       </div>

       <div class="form-group">
         <textarea id="editor" name="editor">{{ old('editor') }}</textarea>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Создать</button>
      </form>
   </div>
 </div>


 <script src="/plugins/ckeditor/ckeditor.js"></script>
 <script type="text/javascript">
    CKEDITOR.replace('editor');
  </script>
@stop
