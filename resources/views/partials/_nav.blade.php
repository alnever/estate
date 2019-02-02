<!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('pages.index', app()->getLocale()) }}">
      {{ __('messages.title') }}
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ Request::is('/') || Request::is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pages.index', app()->getLocale()) }}">{{ __('messages.catalog') }}</span></a>
      </li>
      <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pages.about', app()->getLocale()) }}">{{ __('messages.about') }}</a>
      </li>
      <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pages.contact', app()->getLocale()) }}">{{ __('messages.contact') }}</a>
      </li>
    </ul>

    <ul class="navbar-nav mr-2">
      @guest
        <li class="nav-item {{ Request::is('login') ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
        </li>
      @endguest

      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('estates.index', app()->getLocale()) }}">{{ __('messages.dashboard') }}</a>
            <div class="dropdown-divider"></div>
            <!-- logout button -->
            {{ Form::open(['route' => ['logout',app()->getLocale()], 'method' => 'POST']) }}
              {{ Form::submit(__('messages.logout'), ['class' => 'dropdown-item'])}}
            {{ Form::close() }}
            <!-- end of logout button -->
          </div>
        </li>
      @endauth
    </ul>
  </div>
</nav>
