<!DOCTYPE html>
<html lang="en" dir="ltr">

  @include('partials._head')

  <body>

    @include('partials._nav')

    <div class="container">
        @include('partials._manage')
        @yield('content')
    </div>

    @include('partials._footer')

    @include('partials._scripts')

  </body>
</html>
