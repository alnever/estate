@extends('layouts.admin')

@section('title', '| Locations')

@section('content')
    <div class="row">
        <div class="col-9 pt-2">
            <h3>Locations</h3>
            <!-- messages area -->
            @include('partials._messages')
            <!-- should be table -->
            <table class="table">
                <thead>
                    <th width="10%">#</th>
                    <th width="60%">Location name</th>
                    <th width="30%"></th>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                        <tr>
                            <td>{{ $location->id }}</td>
                            <td>{{ $location->name }}</td>
                            <td class="d-flex flex-row justify-content-end">
                                <a href="{{ route('locations.edit', [app()->getLocale(), $location->id]) }}" class="btn btn-primary btn-admin">
                                    Edit
                                </a>
                                {{ Form::open(['route' => ['locations.destroy', app()->getLocale(), $location->id], 'method' => 'DELETE']) }}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger ml-2 btn-admin'])}}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-3 p-0">
            <!-- the form for adding a new location -->
            <div class="p-2 border border-secondary rounded">
                <h3>New location</h3>
                {{ Form::open(['route' => ['locations.store', app()->getLocale()], 'method' => 'POST']) }}
                    {{ Form::label('name','Location name:')}}
                    {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                    {{ Form::submit('Save', ['class' => 'btn btn-success mt-2 btn-admin'])}}
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
