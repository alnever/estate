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
            <div class="d-flex flex-column border border-light rounded bg-semi-light m-2 p-2">
                <h3 class="text-light">Contact with a Realtor</h3>
                <p class="text-white">If you're interested in this estate, feel free to send a message to our realtors using the contact form below</p>
                {{ Form::open(['method' => 'POST', 'name' => 'message-form']) }}
                    {{ csrf_field() }}
                    {{ Form::hidden('estate_id', $estate->id)}}
                    <div class="mt-2">
                        {{ Form::label('email','Your email:', ['class' => 'h4 text-white'])}}
                        {{ Form::email('email',null, ['class' => 'form-control', 'placeholder' => 'Enter a valid email address...']) }}
                    </div>
                    <div class="mt-2">
                        {{ Form::label('message','Your message:', ['class' => 'h4 text-white'])}}
                        {{ Form::textarea('max_price',null, ['class' => 'form-control', 'rows' => 5]) }}
                    </div>
                    {{ Form::submit('Send a message', ['class' => 'btn btn-success btn-block mt-2']) }}
                {{ Form::close() }}
            </div>
        </div>
      </div>
    </div>

    <!-- main body -->
    <div class="container mt-2">
        <div class="row">
            <div class="col-6">
                <img src="{{ asset('uploads/images/' . $estate->main_image) }}" class="info-image"/>
            </div>
            <div class="col-6">
                <h2>{{ $estate->title }}</h2>
                <h3>
                    @foreach ($estate->locations as $location)
                        <span class="badge badge-secondary">{{ $location->name }}</span>
                    @endforeach
                </h3>
                <p>
                    {!! $estate->description !!}
                </p>
            </div>
        </div>
    </div>

@endsection
