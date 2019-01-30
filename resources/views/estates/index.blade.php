@extends('layouts.admin')

@section('title', '| Estates')

@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <h3 class="d-flex flex-row justify-content-between">
                <span>Estates</span>
                <a href="{{ route('estates.create') }}" class="btn btn-success">Add new estate</a>
            </h3>
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
        </div>
    </div>

@endsection
