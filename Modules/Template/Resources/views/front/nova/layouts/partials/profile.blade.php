<div class="profile">
  @if (Auth::check())
    <div class="profile_pic">
      <a href="/profile"><img src="{{ Auth::user()->getPhoto() }}" class="img-circle profile_img"></a>
    </div>
    <div class="profile_info">
      <span>Добро пожаловать,</span>
      <h2>{{ Auth::user()->name }}</h2>
    </div>
  @else
    <div class="profile_pic">
      <a href="/login"><img src="/images/user.png" class="img-circle profile_img"></a>
    </div>
    <div class="profile_info">
      <span>Добро пожаловать,</span>
      <h2>гость</h2>
    </div>
  @endif
</div>
