<h1>Menu start</h1>
@if (count($menu->menuActivatedItems))
  @foreach ($menu->menuActivatedItems as $item)
    <ul>
      @include ('menu::partials.render.render')
    </ul>
  @endforeach
@else
  @include ('menu::partials.render.none')
@endif
