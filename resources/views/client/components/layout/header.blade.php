<header style="height: unset" class="pt-4 pb-3">
  <nav class="navbar navbar-expand-lg py-0 justify-content-center">
    <div class="d-flex justify-content-center align-items-center gap-4">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex">
        <div class="logo-image">
          <img src="{{ asset('assets/images/client/images/abie-production-logo.png') }}" alt="abie-production-logo">
        </div>

        <div class="ap-navigation">
          <a class="navbar-brand float-none mr-0 d-block" href="/"><h2 class="text-center">Abie Production • Wedding Organizer</h2></a>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item @yield('index')">
                  <a class="nav-link" href="{{ route('client.index') }}">Beranda
                    <span class="sr-only">(current)</span>
                  </a>
                </li> 
                <li class="nav-item @yield('schedule')">
                  <a class="nav-link" href="{{ route('client.schedule.index') }}">Jadwal</a>
                </li>
                <li class="nav-item @yield('news')">
                  <a class="nav-link" href="{{ route('client.news.index') }}">Berita</a>
                </li>
                <li class="nav-item @yield('promo')">
                  <a class="nav-link" href="{{ route('client.promo.index') }}">Promo</a>
                </li>
                <li class="nav-item @yield('venue')">
                  <a class="nav-link" href="{{ route('client.venue.index') }}">Tempat Acara</a>
                </li>
                <li class="nav-item @yield('packet')">
                  <a class="nav-link" href="{{ route('client.packet.index') }}">Paket</a>
                </li>
                <li class="nav-item @yield('gallery')">
                  <a class="nav-link" href="{{ route('client.gallery.index') }}">Gallery</a>
                </li>
                <li class="nav-item @yield('contact') dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown">Hubungi Kami</a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a href="{{ route('client.contact.index') }}" class="dropdown-item" href="#">Kontak</a>
                    <a href="{{ route('client.review.index') }}" class="dropdown-item" href="#">Ulasan</a>
                    <a href="{{ route('client.guide.index') }}" class="dropdown-item" href="#">Cara Pemesanan</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="ap-right-panel d-flex align-items-center">
          <div class="ap-account d-flex gap-2 align-items-center justify-content-end">
            
            @client
            <div class="user-info dropdown d-flex show">
              <i class="fa fa-user mr-3 dropdown-toggle" aria-hidden="true" data-toggle="dropdown"></i>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                {{-- <a href="{{ route('client.profile.index') }}" class="dropdown-item" href="#">Profil</a> --}}
                <a href="{{ route('client.payment.index') }}" class="dropdown-item" href="#">Transaksi</a>
              </div>
            </div>
            <p class="text-white">{{ auth()->user()->name }}</p>
            
            <a 
              href="{{ route('logout') }}" 
              class="d-flex align-items-center justify-content-center" 
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
              <i class="fa fa-sign-out ml-3" aria-hidden="true"></i>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </a>
            @endclient

            @guest
            <a href="{{ route('login') }}" class="filled-button">Masuk</a>
            {{-- <a href="{{ route('register') }}" class="filled-button">Daftar</a> --}}
            <a href="{{ route('client.register.index') }}" class="filled-button">Daftar</a>
            @endguest

          </div>

          <div class="ap-search ml-4 d-flex gap-4 align-items-center justify-content-end">
            {{-- <div class="ap-search-input">
              <i class="fa fa-search" aria-hidden="true"></i>
              <input type="text" name="search" placeholder="search">
            </div> --}}

            @client
            <i class="ap-right-icon fa fa-bell" aria-hidden="true"></i>
            
            <a href="{{ route('client.cart.index') }}">
              <i class="ap-right-icon fa fa-shopping-bag" aria-hidden="true"></i>
              @if ($cart_count)
                <span class="badge badge-pill badge-danger">{{ $cart_count }}</span>
              @endif
            </a>
            @endclient
          </div>
        </div>
      </div>
  </nav>
</header>