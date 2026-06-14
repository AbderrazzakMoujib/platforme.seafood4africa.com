<header class="site-header">
  <div class="container">
    <div class="header-inner">

      {{-- Logo --}}
      <div class="header-logo">
        <a href="{{ route('home') }}">
          <img src="{{ asset("img/LOGO- SEAFOOD 4 AFRICA FORUM AFRICAIN DE L'INDUSTRIE DE LA PÊCHE ET DE L'AQUACULTURE MAROC - DAKHLA - 04 AU 06 FEVRIER 2026_2nd EDITION_white.webp") }}" alt="SeaFood4Africa" width="180">
        </a>
      </div>

      {{-- Search (desktop) --}}
      <div class="header-search d-none d-lg-flex">
        <form action="{{ route('search') }}" method="GET">
          <input type="text" name="SearchItem" placeholder="Search company and product">
          <button type="submit"><img src="{{ asset('img/searchicon.svg') }}" alt="search"></button>
        </form>
      </div>

      {{-- Nav links (desktop) --}}
      <nav class="header-nav d-none d-lg-flex">
        <a href="{{ route('b2b') }}">B2B</a>
        @auth
          <a href="{{ route('resources') }}">EXCHANGE</a>
        @else
          <a href="#" class="open-modal">EXCHANGE</a>
        @endauth
        <div class="nav-dropdown">
          <span>INFORM CENTER</span>
          <ul>
            <li><a href="{{ route('product') }}">Products</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
          </ul>
        </div>
      </nav>

      {{-- Auth buttons (desktop) --}}
      <div class="header-auth d-none d-lg-flex">
        @auth
          <a href="{{ url('/dashboard') }}" class="auth-icon"><i class="fas fa-tachometer-alt"></i></a>
        @else
          <a href="{{ route('login') }}" class="auth-icon"><i class="fas fa-sign-in-alt"></i></a>
          <a href="{{ route('register') }}" class="auth-icon"><i class="fas fa-user-plus"></i></a>
        @endauth
      </div>

      {{-- Mobile right --}}
      <div class="header-mobile-right d-flex d-lg-none">
        @auth
          <a href="{{ route('dashboard') }}" class="auth-icon"><i class="fas fa-user"></i></a>
        @else
          <a href="{{ route('login') }}" class="auth-icon"><i class="fas fa-sign-in-alt"></i></a>
          <a href="{{ route('register') }}" class="auth-icon"><i class="fas fa-user-plus"></i></a>
        @endauth
        <button class="burger-btn" id="burgerBtn" aria-label="Menu">
          <span></span><span></span><span></span>
        </button>
      </div>

    </div>{{-- end header-inner --}}

  </div>

  {{-- Mobile menu --}}
  <div class="mobile-nav" id="mobileNav">

    {{-- Search inside mobile menu --}}
    <div class="mobile-nav-search">
      <form action="{{ route('search') }}" method="GET">
        <input type="text" name="SearchItem" placeholder="Search company and product">
        <button type="submit"><img src="{{ asset('img/searchicon.svg') }}" alt="search"></button>
      </form>
    </div>

    <ul>
      <li><a href="{{ route('b2b') }}">B2B</a></li>
      @auth
        <li><a href="{{ route('resources') }}">EXCHANGE</a></li>
      @else
        <li><a href="#" class="open-modal">EXCHANGE</a></li>
      @endauth
      <li><a href="{{ route('product') }}">Products</a></li>
      <li><a href="{{ route('about') }}">About Us</a></li>
      <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
  </div>

</header>
