@if ($menu->activated==1)
  <ul class="nav navbar-nav">
    @foreach ($menu->menuActivatedItems as $item)
      @if (RoleHelper::validatePermissionForPage($item->role->permission))
      <li>
          <a target="{{ $item->target }}" href="{{ $item->url }}">{{ $item->title }}</a>
      </li>
      @endif
    @endforeach
  </ul>
@endif
