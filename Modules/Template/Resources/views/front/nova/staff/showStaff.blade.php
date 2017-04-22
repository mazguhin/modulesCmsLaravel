  @extends ('template::front.nova.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
    {{ $staff->fullName }}

    @if (RoleHelper::isAdmin())
    <a class="btn btn-primary btn-sm" href="/dashboard/staff/edit/id/{{ $staff->id }}">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>

    <a href="/dashboard/staff/delete/id/{{ $staff->id }}">
      <a class="btn btn-danger btn-sm" href="/dashboard/staff/{{ $staff->id }}"
          onclick="event.preventDefault();
                   document.getElementById('destroy-form').submit();">
          <i class="fa fa-trash" aria-hidden="true"></i>
      </a>

      <form id="destroy-form" action="/dashboard/staff/{{ $staff->id }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
      </form>
    </a>
    @endif
</h1>


<div class="staff">
  <p>
  @if ($staff->photo=="")
    <img src="/images/user.png" class="img-responsive" alt="Фото">
  @else
    <img src="{{ Storage::url($staff->photo) }}" class="img-responsive" alt="Фото">
  @endif
  </p>

  <p><b>Занимаемые должности:</b> {{ $staff->position }}</p>
  <p><b>Преподаваемые дисциплины:</b> {{ $staff->disciplines }}</p>
  <p><b>Ученая степень:</b> {{ $staff->academicDegree }}</p>
  <p><b>Ученое звание:</b> {{ $staff->academicTitle }}</p>
  <p><b>Общий стаж работы:</b> {{ $staff->generalExperience }}</p>
  <p><b>Стаж работы по специальности:</b> {{ $staff->specialtyExperience }}</p>
  <p><b>Наименование направления подготовки и (или) специальности:</b> {{ $staff->specialty }}</p>
  <p><b>Данные о повышении квалификации и (или) профессиональной переподготовке:</b> {{ $staff->training }}</p>
</div>

@stop

@section ('localcss')
  .staff {
    text-align: center;
  }

  .staff .img-responsive {
    margin: 0 auto;
  }
@stop
