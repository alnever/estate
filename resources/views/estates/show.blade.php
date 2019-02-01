@extends('layouts.admin')

@section('title', '| Estates')

@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <!-- form header -->
            <h3 class="d-flex flex-row justify-content-between">
                <span>Estate: {{ $estate->address }}</span>
                <div class="d-flex flex-row">
                    <a href="{{ route('estates.edit', $estate->id) }}" class="btn btn-primary ml-2 btn-admin">Edit</a>
                    {{ Form::open(['route' => ['estates.destroy', $estate->id], 'method' => 'DELETE']) }}
                        {{ Form::submit('Delete',['class' => 'btn btn-danger btn-admin ml-2']) }}
                    {{ Form::close() }}
                    <a href="{{ route('estates.index') }}" class="btn btn-warning ml-2 btn-admin">Back to the List</a>
                </div>
            </h3>
            <!-- end of form header -->

            <!-- messages area -->
            @include('partials._messages')

            <!-- form body -->
            <div class="row d-flex flex-row mt-2 justify-content-between">
                <div class="col-4 d-flex flex-row align-items-center">
                    Goal:<strong>{{ $estate->goal->name }}</strong>
                </div>
                <div class="col-4 d-flex flex-row align-items-center">
                    Estate type: <strong>{{ $estate->estateType->name }}</strong>
                </div>
                <div class="col-4 d-flex flex-row align-items-center">
                    @if ($estate->realtor)
                        Realtor: <strong>{{ $estate->realtor->name }}</strong>
                    @endif
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded">
                <h4>Identication:</h4>
                <strong>Locations:</strong>
                <h4>
                    @foreach ($estate->locations as $location)
                        <span class=" badge badge-secondary">{{ $location->name }}</span>
                    @endforeach
                </h4>

                <div class="row d-flex flex-row mt-2">
                    <div class="col-4 d-flex flex-row align-items-center">
                        Rooms: <strong>{{ $estate->rooms }}</strong>
                    </div>
                    <div class="col-4 d-flex flex-row align-items-center">
                        Sqiare: <strong>{{ $estate->square }}</strong>
                    </div>
                    <div class="col-4 d-flex flex-row align-items-center">
                        Floor: <strong>{{ $estate->floor }}</strong>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 justify-content-between m-1 mt-2 border border-danger rounded">
                <h4>Prices:</h4>
                <div class="row d-flex flex-row p-2 justify-content-between m-1 mt-2 font-weight-bold">
                    <div class="col-4 d-flex flex-row align-items-center">
                        Price: <strong class="text-primary">{{ $estate->price }}</strong>
                    </div>
                    <div class="col-4 d-flex flex-row align-items-center">
                        Minimal Price: <strong class="text-danger">{{ $estate->min_price }}</strong>
                    </div>
                    <div class="col-4 d-flex flex-row align-items-center">
                        Final Price: <strong class="text-success">{{ $estate->final_price }}</strong>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded">
                <h4>Advertisment information:</h4>
                <div class="d-flex flex-row">
                    <div class="col-4">
                        <img src="{{ asset('uploads/images/' . $estate->main_image) }}" alt="" class='info-image'>
                    </div>
                    <div class="col-8">
                        <h5>{{ $estate->title }}</h5>
                        <p>
                            {!! $estate->description !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded">
                <h4>Additional information:</h4>
                <div class="d-flex flex-column mt-2">
                    <strong>Information about the estate:</strong>
                    <p>
                        {!! $estate->object_info !!}
                    </p>
                </div>

                <div class="d-flex flex-column mt-2">
                    <strong>Information about owners of the estate:</strong>
                    <p>
                        {!! $estate->owner_info !!}
                    </p>
                </div>

                <div class="d-flex flex-column mt-2">
                    <strong>Final information:</strong>
                    <p>
                        {!! $estate->final_info !!}
                    </p>
                </div>
            </div>

            <!-- form footer -->
            <h3 class="d-flex flex-row justify-content-between mt-2">
                <span>&nbsp;</span>
                <div class="d-flex flex-row">
                    <a href="{{ route('estates.edit', $estate->id) }}" class="btn btn-primary ml-2 btn-admin">Edit</a>
                    {{ Form::open(['route' => ['estates.destroy', $estate->id], 'method' => 'DELETE']) }}
                        {{ Form::submit('Delete',['class' => 'btn btn-danger btn-admin ml-2']) }}
                    {{ Form::close() }}
                    <a href="{{ route('estates.index') }}" class="btn btn-warning ml-2 btn-admin">Back to the List</a>
                </div>
            </h3>
        </div>
    </div>

@endsection
