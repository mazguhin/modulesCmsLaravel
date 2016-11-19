<h1>Menu start</h1>
@foreach ($menu->menuActivatedItems as $item)
  <ul>
    <li>{{ $item->title }}</li>

    @if (count($item->childrenActivated)>0)
      <ul>
        @foreach ($item->childrenActivated as $child)
          <li>{{ $child->title }}</li>
        @endforeach
      </ul>
    @endif
  </ul>
@endforeach
