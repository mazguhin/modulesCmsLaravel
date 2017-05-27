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
        <p><a href="/club/id/{{ $club->id }}/news/create" class="btn btn-sm btn-default col-xs-12"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить новость</a></p>
        <p><a href="/club/id/{{ $club->id }}/info/create" class="btn btn-sm btn-primary col-xs-12"><i class="fa fa-plus" aria-hidden="true"></i> Добавить страницу</a></p>
        @endif

        @if (RoleHelper::isAdmin())
        <p><a href="/dashboard/club/edit/id/{{ $club->id }}" class="btn btn-sm btn-warning col-xs-12"><i class="fa fa-pencil" aria-hidden="true"></i> Редактировать клуб</a></p>
        <p><a class="btn btn-sm btn-danger col-xs-12" href="/dashboard/club/{{ $club->id }}"
            onclick="event.preventDefault();
                     document.getElementById('destroy-form{{$club->id}}').submit();">
            <i class="fa fa-trash" aria-hidden="true"></i> Удалить клуб
        </a></p>

        <form id="destroy-form{{$club->id}}" action="/dashboard/club/{{ $club->id }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
        @endif
      </div>

    </div>

  </section>

</div>
