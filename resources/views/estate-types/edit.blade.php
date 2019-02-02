@extends('layouts.admin')

@section('title', '| Estate types')

@section('content')
    <div class="row">
        <div class="col-9 pt-2">
            <h3>Edit estate type</h3>
            <!-- messages area -->
            @include('partials._messages')
            <!-- edit form be table -->
            {{ Form::model($estateType, ['route' => ['estate-types.update', app()->getLocale(), $estateType->id], 'method' => 'PUT']) }}
                {{ Form::label('name','Location name:')}}
                {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                <div class="d-flex flex-row mt-2 justify-content-end">
                    {{ Form::submit('Save', ['class' => 'btn btn-success btn-admin'])}}
                    <a href="{{ url()->previous() }}" class="btn btn-warning ml-2 btn-admin">Cancel</a>
                </div>
            {{ Form::close() }}

    </div>

@endsection
