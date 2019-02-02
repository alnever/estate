<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ Request::is('estates*') ? 'active' : '' }}" href="{{ route('estates.index', app()->getLocale()) }}">Estates</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('locations*') ? 'active' : '' }}" href="{{ route('locations.index', app()->getLocale()) }}">Locations</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('estate-types*') ? 'active' : '' }}" href="{{ route('estate-types.index', app()->getLocale()) }}">Estate Types</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Messages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Users</a>
  </li>
</ul>
