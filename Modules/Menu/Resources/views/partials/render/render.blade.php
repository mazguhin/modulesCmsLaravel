<li>{{ $item->title }}</li>
@if (count($item->childrenActivated)>0)
  <ul>
    @foreach ($item->childrenActivated as $item)
      @include ('menu::partials.render.render', ['item'=>$item])
    @endforeach
  </ul>
@endif
