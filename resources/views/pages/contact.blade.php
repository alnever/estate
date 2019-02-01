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
                <form class="" action="" method="POST">

                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="email">Your email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email here">
                  </div>

                  <div class="form-group">
                    <label for="topic">Topic:</label>
                    <input type="text" class="form-control" name="topic" placeholder="Enter your topic here">
                  </div>

                  <div class="form-group">
                    <label for="content">Message:</label>
                    <textarea class="form-control" name="content" rows="7">
                    </textarea>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send message</button>
                  </div>

                </form>
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
