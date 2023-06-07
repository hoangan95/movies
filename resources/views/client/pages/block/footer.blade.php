<footer>
  <!-- Start Categories footer-navbar -->
  <nav class="navbar footer-navbar">
    <div class="container">
      <ul class="nav footer-nav m-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('client.home') }}">Trang chủ</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('client.movie.theaters') }}">Phim chiếu rạp</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="{{ route('client.series.movie') }}">Phim bộ</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('client.movie.tvshow') }}">TV shows</a>
        </li>
       
      </ul>
    </div>
  </nav>

  <div class="copy-right pt-4 pb-4">
    <div class="container">
      <div class="text-center">
        <p>Copyright © Aster-Cima With over +10000 Movies and Series for Free</p>
        <i>
          <small>This site does not store any files on our server, we only linked to the media which is hosted on 3rd party services.</small>
        </i>
      </div>
    </div>
  </div>
</footer>