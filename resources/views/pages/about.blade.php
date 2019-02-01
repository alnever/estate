@extends('layouts.front-end')

@section('title', '| Home')

@section('content')
    <!-- header -->
    <div class="header">
      <div class="row">
        <div class="col-8">
            <h1 class="display-1 text-white">Real Estate Agency</h1>
            <h3 class="text-white">Aliquam erat volutpat. Fusce congue, nisi at pulvinar rutrum, mi lorem interdum justo, vitae bibendum sapien libero at odio. Nunc pellentesque tellus non sem pellentesque porttitor. Nullam quis elit eu magna dignissim sodales. Sed at lorem pellentesque, eleifend turpis id, vehicula mi. Nam quis elit in dolor sodales elementum vel at ex.</h3>
        </div>
        <div class="col-4">
            {{-- something --}}
        </div>
      </div>
    </div>

    <!-- main body -->
    <div class="container mt-2">
        <div class="row">
            <div class="col-12">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a tortor ac ipsum feugiat dignissim. Sed accumsan feugiat velit, at ornare dolor viverra sit amet. Vestibulum gravida nunc libero, quis vestibulum tortor posuere eu. Nunc quis tristique lorem, et blandit neque. Maecenas lacinia mi in lobortis tempor. Fusce at pretium lacus. In neque metus, elementum blandit tincidunt vel, posuere non lorem. Etiam pulvinar commodo ex non efficitur. Sed ex sem, pulvinar in commodo nec, auctor id orci. Phasellus molestie ante quis ex ullamcorper hendrerit. Proin malesuada, augue vel hendrerit semper, dolor diam condimentum nibh, vitae blandit eros tellus ac ante. Etiam convallis posuere nisl, in tincidunt turpis. Suspendisse quis convallis ex.

                Integer sollicitudin ipsum vel tellus sollicitudin fringilla quis ac est. Nunc elementum dui dolor, sit amet ullamcorper tellus faucibus eget. In malesuada turpis eget risus venenatis venenatis. Maecenas elementum nulla nec viverra mattis. Donec nec sem sit amet metus congue ornare. Phasellus lobortis interdum nulla nec tempus. Integer sodales sem leo, vitae rutrum purus elementum in. Sed luctus metus velit, in ultrices nisl tristique in. Integer vitae porta odio. Nunc sapien diam, mattis posuere dictum sit amet, fermentum id leo. Maecenas malesuada auctor ultricies. Donec ut euismod sapien. Suspendisse potenti. Quisque in pharetra nisi. Nunc a orci at est facilisis auctor eget eget eros. Curabitur ex felis, finibus at mollis vel, lobortis at nibh.
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- for select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
      $('.locations-select').select2();
    </script>
@endsection
