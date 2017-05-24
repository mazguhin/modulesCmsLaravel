@extends ('template::front.nova.layouts.main')

@section ('content')
@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<div class="x_panel">
  <ol class="breadcrumb">
    <li><a href="/staff/category">Категории</a></li>
    <li class="active">Просмотр категории</li>
  </ol>
  <div class="x_content">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <h1>{{ $category->name }}</h1>
        {{ $staffs->links() }}
      </div>

      <div class="clearfix"></div>

      @foreach ($staffs as $staff)
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="left col-md-4 col-sm-4 col-xs-12 text-center">
            <img src="{{ $staff->getPhoto() }}" alt="{{$staff->fullName}}" class="img-circle img-responsive">
          </div>
          <h4 class="brief"><i>{{ $staff->position }}</i></h4>
          <div class="right col-md-8 col-sm-8 col-xs-12">
            <h2>{{ $staff->fullName }}</h2>
            <p><strong>Дисциплины: </strong> {{ $staff->disciplines }} </p>
            <p><b>Ученая степень:</b> {{ $staff->academicDegree }}</p>
            <p><b>Ученое звание:</b> {{ $staff->academicTitle }}</p>
            <p><b>Общий стаж работы:</b> {{ $staff->generalExperience }}</p>
            <p><b>Стаж работы по специальности:</b> {{ $staff->specialtyExperience }}</p>
            <p><b>Наименование направления подготовки и (или) специальности:</b> {{ $staff->specialty }}</p>
            <p><b>Данные о повышении квалификации и (или) профессиональной переподготовке:</b> {{ $staff->training }}</p>

          </div>
        </div>
        @if (RoleHelper::isAdmin())
        <div class="panel-footer">
          <div class="text-center">
            <a href="/dashboard/staff/edit/id/{{ $staff->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Редактировать </a>

            <a class="btn btn-danger btn-xs" href="/dashboard/staff/{{ $staff->id }}"
              onclick="event.preventDefault();
              document.getElementById('destroy-form{{ $staff->id }}').submit();">
              <i class="fa fa-trash-o"></i> Удалить
            </a>

            <form id="destroy-form{{ $staff->id }}" action="/dashboard/staff/{{ $staff->id }}" method="POST" style="display: none;">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            </form>
          </div>
        </div>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</div>
@stop
