<li role="presentation" class="dropdown">
  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-bell-o"></i>
    <!-- <span class="badge bg-green">6</span> -->
  </a>
  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
    @foreach (Logs::latestOtherLogs() as $log)
    <li>
      <a>
        <span class="image"><img src="{{$log->user->getPhoto()}}" alt="Profile Image" /></span>
        <span>
          <span><b>{{$log->user->name}}</b></span>
          <span class="time">{{$log->created_at->diffForHumans()}}</span>
        </span>
        <span class="message">
          {{$log->body}}
        </span>
      </a>
    </li>
    @endforeach
  </ul>
</li>
