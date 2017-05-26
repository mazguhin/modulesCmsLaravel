@if (count($menus)>0)
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <br>
      <h3>Главное меню</h3>
      <ul class="nav side-menu">
      @foreach ($menus as $menu)
        @if ($menu->activated==1)
        <li>

          @if (empty($menu->url))
            <a><i class="fa {{ $menu->icon }}"></i> {{ $menu->title }}<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
            @foreach ($menu->menuActivatedItems as $item)
              @if (RoleHelper::validatePermissionForPage($item->role->permission))
              <li>
                  <a target="{{ $item->target }}" href="{{ $item->url }}">{{ $item->title }}</a>
              </li>
              @endif
            @endforeach
            </ul>
          @else
          <a href="{{ $menu->url }}"><i class="fa {{ $menu->icon }}"></i> {{ $menu->title }}</a>
          @endif
        </li>
        @endif
      @endforeach

      </ul>

    </div>
  </div>
@endif
