<nav class="navbar navbar-expand-lg navbar-dark-custom sticky-top">
  <div class="container px-0">
    <a class="navbar-brand" href="{{ route('home') }}">
      @include('components.logo')
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link{{ request()->routeIs('home') ? ' active' : '' }}" href="{{ route('home') }}">{{ __('app.nav.home') }}</a></li>
        <li class="nav-item"><a class="nav-link{{ request()->routeIs('lessons.*') ? ' active' : '' }}" href="{{ route('lessons.index') }}">{{ __('app.nav.lessons') }}</a></li>
        <li class="nav-item"><a class="nav-link{{ request()->routeIs('categories.*') ? ' active' : '' }}" href="{{ route('categories.index') }}">{{ __('app.nav.categories') }}</a></li>
        <li class="nav-item"><a class="nav-link{{ request()->routeIs('ai.analyzer') ? ' active' : '' }}" href="{{ route('ai.analyzer') }}">{{ __('app.nav.ai_analyzer') }}</a></li>
        <li class="nav-item"><a class="nav-link{{ request()->routeIs('about') ? ' active' : '' }}" href="{{ route('about') }}">{{ __('app.nav.about') }}</a></li>
      </ul>

      <div class="d-flex align-items-center">
        <form class="d-flex align-items-center" action="{{ route('lessons.index') }}" method="get">
          <input name="search" value="{{ request('search') }}" class="form-control form-control-dark me-2" type="search" placeholder="{{ __('app.nav.search_placeholder') }}">
          <button class="btn btn-outline-white" type="submit">{{ __('app.nav.search') }}</button>
        </form>

        <!-- Public Language Quick Switcher -->
        <div class="dropdown ms-2">
          <button class="btn btn-outline-white dropdown-toggle px-2 py-1" type="button" id="langDropdownNav" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.85rem;">
            {{ App::getLocale() == 'en' ? '🇺🇸 EN' : '🇮🇩 ID' }}
          </button>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-lg border-secondary border-opacity-25 mt-2" aria-labelledby="langDropdownNav" style="background: rgba(17, 17, 17, 0.95); backdrop-filter: blur(20px); border-radius: 14px; min-width: 160px;">
            <li>
              <a class="dropdown-item text-white rounded-pill my-1 d-flex justify-content-between align-items-center {{ App::getLocale() == 'id' ? 'fw-bold active bg-secondary bg-opacity-25' : '' }}" href="{{ route('lang.switch', 'id') }}">
                <span>🇮🇩 {{ __('app.nav.indonesian') }}</span>
                @if(App::getLocale() == 'id') <small class="text-success fw-bold">✓</small> @endif
              </a>
            </li>
            <li>
              <a class="dropdown-item text-white rounded-pill my-1 d-flex justify-content-between align-items-center {{ App::getLocale() == 'en' ? 'fw-bold active bg-secondary bg-opacity-25' : '' }}" href="{{ route('lang.switch', 'en') }}">
                <span>🇺🇸 {{ __('app.nav.english') }}</span>
                @if(App::getLocale() == 'en') <small class="text-success fw-bold">✓</small> @endif
              </a>
            </li>
          </ul>
        </div>

        @guest
          <a href="{{ route('opening') }}" class="btn btn-outline-white ms-2 px-3 py-1 text-decoration-none">{{ __('app.nav.login') }}</a>
        @endguest

        @auth
          <div class="dropdown ms-2">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle border border-secondary border-opacity-50 p-1 rounded-circle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" width="36" height="36" class="rounded-circle" style="object-fit: cover;">
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-lg border-secondary border-opacity-25 mt-2" aria-labelledby="userDropdown" style="background: rgba(17, 17, 17, 0.95); backdrop-filter: blur(20px); border-radius: 16px; padding: 0.5rem; min-width: 210px;">
              <li class="px-3 py-2 border-bottom border-secondary border-opacity-25">
                <div class="fw-bold text-white small">{{ Auth::user()->name }}</div>
                <div class="text-muted-custom" style="font-size: 0.75rem;">{{ Auth::user()->email ?: Auth::user()->phone }}</div>
              </li>
              <li><a class="dropdown-item text-white rounded-pill my-1" href="#" data-bs-toggle="modal" data-bs-target="#modalMyProfile">{{ __('app.nav.my_profile') }}</a></li>
              <li><a class="dropdown-item text-white rounded-pill my-1" href="#" data-bs-toggle="modal" data-bs-target="#modalMyLearning">{{ __('app.nav.my_learning') }}</a></li>
              <li><a class="dropdown-item text-white rounded-pill my-1" href="#" data-bs-toggle="modal" data-bs-target="#modalBookmarks">{{ __('app.nav.bookmarks') }}</a></li>
              <li><a class="dropdown-item text-white rounded-pill my-1" href="#" data-bs-toggle="modal" data-bs-target="#modalSettings">{{ __('app.nav.settings') }}</a></li>
              
              <!-- Language Selector Section inside Profile Dropdown -->
              <li><hr class="dropdown-divider border-secondary border-opacity-25 my-1"></li>
              <li class="px-3 py-1 text-muted-custom extra-small text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.1em; color: #71737A;">
                {{ __('app.nav.language') }}
              </li>
              <li>
                <a class="dropdown-item text-white rounded-pill my-1 d-flex justify-content-between align-items-center {{ App::getLocale() == 'id' ? 'fw-bold active bg-secondary bg-opacity-25' : '' }}" href="{{ route('lang.switch', 'id') }}">
                  <span>🇮🇩 {{ __('app.nav.indonesian') }}</span>
                  @if(App::getLocale() == 'id') <small class="text-success fw-bold">✓</small> @endif
                </a>
              </li>
              <li>
                <a class="dropdown-item text-white rounded-pill my-1 d-flex justify-content-between align-items-center {{ App::getLocale() == 'en' ? 'fw-bold active bg-secondary bg-opacity-25' : '' }}" href="{{ route('lang.switch', 'en') }}">
                  <span>🇺🇸 {{ __('app.nav.english') }}</span>
                  @if(App::getLocale() == 'en') <small class="text-success fw-bold">✓</small> @endif
                </a>
              </li>

              <li><hr class="dropdown-divider border-secondary border-opacity-25"></li>
              <li>
                <form action="{{ route('public.logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger rounded-pill">{{ __('app.nav.logout') }}</button>
                </form>
              </li>
            </ul>
          </div>
        @endauth
      </div>
    </div>
  </div>
</nav>
