@extends('layouts.admin')

@section('title', '| Estate types')

@section('content')
    <div class="row">
        <div class="col-9 pt-2">
            <h3>Estate Types</h3>
            <!-- messages area -->
            @include('partials._messages')
            <!-- should be table -->
            <table class="table">
                <thead>
                    <th width="10%">#</th>
                    <th width="60%">Estate type</th>
                    <th width="30%"></th>
                </thead>
                <tbody>
                    @foreach ($estateTypes as $estateType)
                        <tr>
                            <td>{{ $estateType->id }}</td>
                            <td>{{ $estateType->name }}</td>
                            <td class="d-flex flex-row justify-content-end">
                                <a href="{{ route('estate-types.edit', $estateType->id) }}" class="btn btn-primary btn-admin">
                                    Edit
                                </a>
                                {{ Form::open(['route' => ['estate-types.destroy', $estateType->id], 'method' => 'DELETE']) }}
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
                <h3>New estate type</h3>
                {{ Form::open(['route' => 'estate-types.store', 'method' => 'POST']) }}
                    {{ Form::label('name','Estate type:')}}
                    {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                    {{ Form::submit('Save', ['class' => 'btn btn-success mt-2 btn-admin'])}}
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
