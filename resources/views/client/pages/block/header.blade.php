<style>

.profile{
  width: 50px;
  height: 40px;
  text-align: center;

 }
    
 .profile-image img {
    width: 70%;
    height: auto;
    border-radius: 0.475rem;
    
}
</style>
<header>
  <nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">
      <a class="navbar-brand" href="{{ route('client.home') }}">
        <img src="{{ asset('client/font/assets/images/logo-3.png') }}" class="img-fluid logo" alt="Logo" />
      </a>

      <!-- Buttons Group -->

      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav flex-md-wrap main-menu m-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('client.home') }}">Trang chủ</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Thể loại</a>
            <ul class="dropdown-menu">
             
            @foreach($categories as $item)
              <li><a class="dropdown-item" href="{{ route('client.category',['slug'=>$item->slug]) }}">{{ $item->name }}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('client.movie.tvshow') }}">TV Show</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('client.series.movie') }}">Phim bộ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('client.movie.theaters') }}">Phim chiếu rạp</a>
          </li>
        </ul>
        <ul class="navbar-nav d-none d-lg-flex me-left">
          <li class="nav-item">
            <a class="me-3 search-btn-header" data-bs-toggle="tooltip" title="Search" href="#">
              <i class="icofont-search"></i>
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
              <i class="icofont-navigation-menu"></i>
          </button>
        </li>
          <li class="nav-item">
            @if (Auth::check() && Auth::user()->level == 2)
              <div class="profile">
                <div class="profile-image">
                   <img src="{{ asset("uploads/".auth()->user()->image) }}"/>
                   <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.logout') }}">Log Out</a>
                  </li>
                </div>
              </div>
            @else
              <span data-bs-toggle="modal" data-bs-target="#login-modal">
                <a class="auth-btn" data-bs-toggle="tooltip" title="Login / Register" href="javascript:void(0)">
                  <i class="icofont-ui-user"></i>
                  <!-- Login / Register -->
                </a>
                
              </span>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>