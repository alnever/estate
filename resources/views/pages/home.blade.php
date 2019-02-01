@extends('layouts.front-end')

@section('title', '| Home')

@section('styles')
    <!-- for select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <!-- header -->
    <div class="header">
      <div class="row">
        <div class="col-8">
            <h1 class="display-1 text-white">Real Estate Agency</h1>
            <h3 class="text-white">Aliquam erat volutpat. Fusce congue, nisi at pulvinar rutrum, mi lorem interdum justo, vitae bibendum sapien libero at odio. Nunc pellentesque tellus non sem pellentesque porttitor. Nullam quis elit eu magna dignissim sodales. Sed at lorem pellentesque, eleifend turpis id, vehicula mi. Nam quis elit in dolor sodales elementum vel at ex.</h3>
        </div>
        <div class="col-4">
            <div class="d-flex flex-column border border-light rounded bg-semi-light m-2 p-2">
                <h3 class="text-light">Find your home</h3>
                {{ Form::open(['route' => 'pages.index', 'method' => 'GET']) }}
                    <div class="mt-2">
                        {{ Form::label('goal','You are looking for:', ['class' => 'h4 text-white'])}}
                        {{ Form::select('goal',$goals,(isset($params['goal']) ? $params['goal'] : null), ['class' => 'form-control', 'placeholder' => 'Pick your goal...']) }}
                    </div>
                    <div class=mt-2>
                        {{ Form::label('locations','Preferred Locations:', ['class' => 'h4 text-white']) }}
                        {{ Form::select('locations[]',$locations,(isset($params['locations']) ? $params['locations'] : null), ['class' => 'form-control locations-select', 'multiple' => 'multiple']) }}
                    </div>
                    <div class="mt-2">
                        {{ Form::label('min_price','Minimal Price:', ['class' => 'h4 text-white'])}}
                        {{ Form::text('min_price',(isset($params['min_price']) ? $params['min_price'] : null), ['class' => 'form-control', 'placeholder' => 'Enter a minimal price...']) }}
                    </div>
                    <div class="mt-2">
                        {{ Form::label('max_price','Maximal Price:', ['class' => 'h4 text-white'])}}
                        {{ Form::text('max_price',(isset($params['max_price']) ? $params['max_price'] : null), ['class' => 'form-control', 'placeholder' => 'Enter a maximal price...']) }}
                    </div>
                    {{ Form::submit('Search', ['class' => 'btn btn-success btn-block mt-2']) }}
                {{ Form::close() }}
            </div>
        </div>
      </div>
    </div>

    <!-- main body -->
    <div class="container mt-2">
        <div class="row">
            @foreach ($estates as $estate)
                <div class="col-4 p-2 estate-block">
                    <!-- here must be estate picture -->
                    <div class="d-block info-block">
                        <div class="image-crop">
                            <img src="{{ asset('uploads/images/'.$estate->main_image) }}" alt="" class="info-image">
                        </div>

                        <div class="info h4 float-right p-2 rounded-pill text-white text-right font-weight-bold bg-success border border-warning">
                            {{ number_format($estate->price, 0, '.', ' ') }}
                        </div>
                    </div>

                    <h3>{{ $estate->title }}</h3>
                    <p>{!! Str::words($estate->description, 30) !!}</p>

                    <a href="{{ route('estates.single', $estate->id) }}" class="btn btn-primary float-right">Show more...</a>
                </div>
            @endforeach
        </div>

        <div class="d-flex flex-row justify-content-center">
            {{ $estates->links() }}
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
