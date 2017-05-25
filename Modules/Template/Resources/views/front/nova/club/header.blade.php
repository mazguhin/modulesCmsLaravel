<ul class="stats-overview">
    <li>
      <a href="/club/id/{{$club->id}}">Новости</a>
    </li>
    @foreach ($club->info->articles as $info)
    <li>
      <a href="/club/id/{{$club->id}}/info/id/{{$info->id}}">{{$info->title}}</a>
    </li>
    @endforeach
</ul>
