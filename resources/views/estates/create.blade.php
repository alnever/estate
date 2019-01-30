@extends('layouts.admin')

@section('styles')
    <!-- for select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- tinyMCE -->
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script type="text/javascript">
      tinymce.init({
        selector: "textarea",
        plugins: 'textcolor lists',
        toolbar: 'undo redo |  bold italic underline | forecolor backcolor | numlist bullist',
        menubar: false
      });
    </script>
@endsection

@section('title', '| Estates')

@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            {{ Form::open(['route' => 'estates.store', 'method' => 'POST'])}}
                <!-- form header -->
                <h3 class="d-flex flex-row justify-content-between">
                    <span>New Estate</span>
                    <div class="d-flex flex-row">
                        {{ Form::submit('Save',['class' => 'btn btn-success btn-admin'])}}
                        <a href="{{ url()->previous() }}" class="btn btn-warning ml-2 btn-admin">Cancel</a>
                    </div>
                </h3>
                <!-- end of form header -->

                <!-- form body -->
                <div class="row d-flex flex-row mt-2 justify-content-between">
                    <div class="col-6 d-flex flex-row align-items-center">
                        {{ Form::label('goal_id','Goal:',['class' => 'mt-2 text-nowrap']) }}
                        {{ Form::select('goal_id', $goals, null, ['class' => 'form-control', 'placeholder' => 'Pick a goal...']) }}
                    </div>
                    <div class="col-6 d-flex flex-row align-items-center">
                        {{ Form::label('estate_type_id','Estate type:',['class' => 'mt-2 text-nowrap']) }}
                        {{ Form::select('estate_type_id', $estateTypes, null, ['class' => 'form-control', 'placeholder' => 'Pick an estate type...']) }}
                    </div>
                </div>

                {{ Form::label('locations','Locations:',['class' => 'mt-2']) }}
                {{ Form::select('locations[]', $locations, null, ['class' => 'form-control locations-select', 'multiple' => 'multiple']) }}

                {{ Form::label('address','Address:',['class' => 'mt-2']) }}
                {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter an address...'])}}

                <div class="row d-flex flex-row mt-2">
                    <div class="col-4 d-flex flex-row align-items-center">
                        {{ Form::label('rooms','Rooms:') }}
                        {{ Form::text('rooms', null, ['class' => 'form-control', 'placeholder' => 'Enter number of rooms...'])}}
                    </div>
                    <div class="col-4 d-flex flex-row align-items-center">
                        {{ Form::label('square','Square:') }}
                        {{ Form::text('square', null, ['class' => 'form-control', 'placeholder' => 'Enter a square...'])}}
                    </div>
                    <div class="col-4 d-flex flex-row align-items-center">
                        {{ Form::label('floor','Floor:') }}
                        {{ Form::text('floor', null, ['class' => 'form-control', 'placeholder' => 'Enter a floor number...'])}}
                    </div>
                </div>

                <div class="row d-flex flex-row p-2 justify-content-between m-1 mt-2 border border-danger rounded font-weight-bold">
                    <div class="col-5 d-flex flex-row align-items-center">
                        {{ Form::label('price','Price:') }}
                        {{ Form::text('price', null, ['class' => 'form-control text-primary font-weight-bold', 'placeholder' => 'Enter a wanted price...'])}}
                    </div>
                    <div class="col-5 d-flex flex-row align-items-center">
                        {{ Form::label('min_price','Minimal price:', ['class' => 'text-nowrap']) }}
                        {{ Form::text('min_price', null, ['class' => 'form-control text-danger font-weight-bold', 'placeholder' => 'Enter a possibly minimal price...'])}}
                    </div>
                </div>

                {{ Form::label('object_info','Information about the estate:',['class' => 'mt-2']) }}
                {{ Form::textarea('object_info', null, ['class' => 'form-control', 'rows' => 5])}}

                {{ Form::label('owner_info','Information about owners of the estate:',['class' => 'mt-2']) }}
                {{ Form::textarea('owner_info', null, ['class' => 'form-control', 'rows' => 5])}}


                <!-- end of form body -->

                <!-- form footer -->
                <h3 class="d-flex flex-row justify-content-between mt-2">
                    <span>&nbsp;</span>
                    <div class="d-flex flex-row">
                        {{ Form::submit('Save',['class' => 'btn btn-success btn-admin'])}}
                        <a href="{{ url()->previous() }}" class="btn btn-warning ml-2 btn-admin">Cancel</a>
                    </div>
                </h3>
                <!-- end of form footer-->
            {{ Form::close() }}
            <!-- messages area -->
            @include('partials._messages')
            <!-- form for estate -->
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
