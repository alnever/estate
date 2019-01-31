@extends('layouts.admin')

@section('title', '| Estates')

@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <h3 class="d-flex flex-row justify-content-between">
                <span>Estates</span>
                <a href="{{ route('estates.create') }}" class="btn btn-success">Add new estate</a>
            </h3>
            <!-- search form -->
            <div class="col-12 d-flex flex-column border border-secondary rounded bg-light p-2">
                <h4>Search parameters:</h4>
                {{ Form::open(['route' => 'estates.index', 'method' => 'GET']) }}
                    <div class="d-flex flex-row m-2 p-2">
                        <div class="col-2">
                            {{ Form::label('sell','Estates for sell') }}
                            {{ Form::checkbox('sell',1, isset($params['sell']) && $params['sell'] == 1) }}
                        </div>
                        <div class="">
                            {{ Form::label('rent','Estates for rent') }}
                            {{ Form::checkbox('rent',1, isset($params['rent']) && $params['rent'] == 1) }}
                        </div>
                    </div>

                    <div class="d-flex flex-row m-2 p-2">
                        <div class="col-3">
                            {{ Form::label('deleted','Show deleted objects')}}
                            {{ Form::checkbox('deleted',1, isset($params['deleted']) && $params['deleted'] == 1) }}
                        </div>
                    </div>

                    {{ Form::submit('Search',['class' => 'btn btn-secondary btn-admin float-right']) }}
                {{ Form::close() }}
            </div>
            <!-- end of search form -->
            <!-- messages area -->
            @include('partials._messages')
            <!-- should be table -->
            <table class="table">
                <thead>
                    <th width="3%">#</th>
                    <th width="5%">Goal</th>
                    <th width="5%">Stage</th>
                    <th width="30%">Estate Description</th>
                    <th width="20%">Owner information</th>
                    <th width="10%">Location</th>
                    <th width="10%">Price</th>
                    <th width="12%">Minimal Price</th>
                    <th width="10%">Realtor</th>
                </thead>
                <tbody>
                    @foreach ($estates as $estate)
                        <tr>
                            <td>{{ $estate->id }}</td>
                            <td>
                                {{ $estate->goal->name }}
                            </td>
                            <td>
                                {{ $estate->stage->name }}
                            </td>
                            <td>
                                <a href="{{ route('estates.show', $estate->id) }}" class="h4 text-primary">{{ $estate->address }}</a>
                                <p class="font-weight-bold">
                                    @if ($estate->rooms)
                                        Rooms: {{ $estate->rooms }}
                                    @endif
                                    @if ($estate->square)
                                        Square: {{ $estate->square }}
                                    @endif
                                    @if ($estate->floor)
                                        Floor: {{ $estate->floor }}
                                    @endif
                                </p>
                            </td>
                            <td>
                                {!! $estate->owner_info !!}
                            </td>
                            <td class="h5">
                                @foreach ($estate->locations as $location)
                                    <span class="badge badge-secondary">{{ $location->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-primary font-weight-bold">
                                {{ $estate->price }}
                            </td>
                            <td class="text-danger font-weight-bold">
                                {{ $estate->min_price }}
                            </td>
                            <td>
                                @if ($estate->realtor)
                                    {{ $estate->realtor->name }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex flex-row justify-content-center">
                {{ $estates->links() }}
            </div>
        </div>
    </div>

@endsection
