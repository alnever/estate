<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="#">Objects</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('locations*') ? 'active' : '' }}" href="{{ route('locations.index') }}">Locations</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Object Types</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Messages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Users</a>
  </li>
</ul>
