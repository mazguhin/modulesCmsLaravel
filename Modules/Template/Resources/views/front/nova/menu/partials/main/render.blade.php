<li>{{ $item->title }}</li>
@if (count($item->childrenActivated)>0)
  <ul>
    @foreach ($item->childrenActivated as $item)
      @include ('template::front.amy.menu.partials.main.render', ['item'=>$item])
    @endforeach
  </ul>
@endif
