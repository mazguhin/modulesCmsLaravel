<div class="well">
  <h4>Категории</h4>
  <div class="row">
    <div class="col-lg-12">
      <ul class="list-unstyled">
        @foreach ($categories as $category)
          <li><a href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
