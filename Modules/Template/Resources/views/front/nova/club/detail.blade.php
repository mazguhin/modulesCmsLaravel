<div class="col-md-3 col-sm-3 col-xs-12">
  <section class="panel">
    <div class="panel-body">
      <h3 class="green">{{ $club->name }}</h3>

      <p>{{ $club->description }}</p>
      <br />

      <div class="project_detail">

        <p class="title">Тип клуба</p>
        <p>
          @if ($club->pay==1)
            Платный
          @else
            Бесплатный
          @endif
        </p>
        <p class="title">Модераторы</p>
        <p>
        @foreach ($club->moders as $moder)
          {{$moder->name}} <br>
        @endforeach
        </p>
      </div>

      <br />

      <div class="mtop20">
        @if (RoleHelper::validatePermissionForClub($club->id))
        <a href="/club/id/{{ $club->id }}/news/create" class="btn btn-sm btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить новость</a>
        <a href="/club/id/{{ $club->id }}/info/create" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Добавить страницу</a>
        @endif

        @if (RoleHelper::isAdmin())
        <a href="/dashboard/club/edit/id/{{ $club->id }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Редактировать клуб</a>
        <a class="btn btn-sm btn-danger" href="/dashboard/club/{{ $club->id }}"
            onclick="event.preventDefault();
                     document.getElementById('destroy-form{{$club->id}}').submit();">
            <i class="fa fa-trash" aria-hidden="true"></i> Удалить клуб
        </a>

        <form id="destroy-form{{$club->id}}" action="/dashboard/club/{{ $club->id }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
        @endif
      </div>

    </div>

  </section>

</div>
