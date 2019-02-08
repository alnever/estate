<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ Request::is('estates*') ? 'active' : '' }}" href="{{ route('estates.index', app()->getLocale()) }}">{{ __('messages.estates') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('locations*') ? 'active' : '' }}" href="{{ route('locations.index', app()->getLocale()) }}">{{ __('messages.locations') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('estate-types*') ? 'active' : '' }}" href="{{ route('estate-types.index', app()->getLocale()) }}">{{ __('messages.estate-types') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">{{ __('messages.messages') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">{{ __('messages.users') }}</a>
  </li>
</ul>
