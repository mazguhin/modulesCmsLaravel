@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
    {{ $club->name }}

    @if (RoleHelper::isAdmin())
    <a class="btn btn-primary btn-sm" href="/dashboard/club/edit/id/{{ $club->id }}">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>

    <a href="/dashboard/club/delete/id/{{ $club->id }}">
      <a class="btn btn-danger btn-sm" href="/dashboard/club/{{ $club->id }}"
          onclick="event.preventDefault();
                   document.getElementById('destroy-form').submit();">
          <i class="fa fa-trash" aria-hidden="true"></i>
      </a>

      <form id="destroy-form" action="/dashboard/club/{{ $club->id }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
      </form>
    </a>
    @endif
</h1>
<div class="row">
  <div class="col-sm-1">
    @if (RoleHelper::validatePermissionForClub($club->id))
      <a href="/club/id/{{ $club->id }}/info/create">
        <button type="button" class="btn btn-primary btn-sm">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
      </a>
    @endif
  </div>
  <a href="/club/id/{{$club->id}}" class="infopages col-sm-2">Новости</a>
  @foreach ($club->info->articles as $info)
    <a href="/club/id/{{$club->id}}/info/id/{{$info->id}}" class="infopages col-sm-2">{{$info->title}}</a>
  @endforeach
</div>
<hr>
