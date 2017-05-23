@extends ('template::back.nova.layouts.main')

@section ('content')

@if (session('result'))
<div class="alert alert-info" role="alert">
  {{ session('result') }}

  @if (session('slug'))
  <div class="btn-group">
    <a href="/staff/{{ session('slug') }}" type="button" class="btn btn-default">Просмотр</a>
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="caret"></span>
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="/staff/{{ session('slug') }}" target="_blank">В новом окне</a></li>
    </ul>
  </div>
  @endif

</div>
@endif

 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Создать нового сотрудника</div>
   </div>


  @include ('template::back.nova.staff.errors')
  <ol class="breadcrumb">
    <li><a href="/dashboard/staff">Сотрудники</a></li>
    <li class="active">Создание сотрудника</li>
  </ol>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/staff/create" enctype="multipart/form-data">
       <div class="form-group">
        <label for="fullName">ФИО*</label>
        <input type="text" class="form-control" id="fullName" value="{{ old('fullName') }}" name="fullName" placeholder="Введите описание" required>
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="position">Занимаемая должность (должности)*</label>
        <input type="text" id="position" value="{{ old('position') }}" name="position" class="form-control" placeholder="Введите описание" required>
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="disciplines">Преподаваемые дисциплины*</label>
        <input type="text" id="disciplines" value="{{ old('disciplines') }}" name="disciplines" class="form-control" placeholder="Введите описание" required>
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="academicDegree">Ученая степень</label>
        <input type="text" id="academicDegree" value="{{ old('academicDegree') }}" name="academicDegree" class="form-control" placeholder="Введите описание">
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="academicTitle">Ученое звание</label>
        <input type="text" id="academicTitle" value="{{ old('academicTitle') }}" name="academicTitle" class="form-control" placeholder="Введите описание">
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="specialty">Наименование направления подготовки и (или) специальности*</label>
        <input type="text" id="specialty" value="{{ old('specialty') }}" name="specialty" class="form-control" placeholder="Введите описание" required>
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="training">Данные о повышении квалификации и (или) профессиональной переподготовке</label>
        <input type="text" id="training" value="{{ old('training') }}" name="training" class="form-control" placeholder="Введите описание">
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="generalExperience">Общий стаж работы*</label>
        <input type="text" id="generalExperience" value="{{ old('generalExperience') }}" name="generalExperience" class="form-control" placeholder="Введите описание" required>
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="specialtyExperience">Стаж работы по специальности*</label>
        <input type="text" id="specialtyExperience" value="{{ old('specialtyExperience') }}" name="specialtyExperience" class="form-control" placeholder="Введите описание" required>
        <p class="help-block"></p>
       </div>

       <div class="form-group">
        <label for="slug">URL</label>
        <input type="text" class="form-control" id="slug" value="{{ old('slug') }}" name="slug" placeholder="Введите URL">
        <p class="help-block">Если вы не знаете предназначение данного поля, то оставьте его неизменным</p>
       </div>

       <div class="form-group" id="fa-select">
         <label for="category">Категория*</label>
         <select class="form-control selectpicker" id="category" name="category[]" title="Выбрать одну/несколько категорий" multiple>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
       </div>

       <div class="form-group">
        <label for="photo">Фото</label>
        <input type="file" name="photo" accept="image/*,image/jpeg">
        <p class="help-block"></p>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Создать</button>
      </form>
   </div>
 </div>
@stop
