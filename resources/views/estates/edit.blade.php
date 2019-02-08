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
            <!-- form for estates -->
            {{ Form::model($estate,['route' => ['estates.update', app()->getLocale(), $estate->id], 'method' => 'PUT', 'files' => true])}}
                <!-- form header -->
                <h3 class="estate-show-header">
                    <span>{{ __('messages.edit') }}: {{ $estate->address}}</span>
                    <div class="d-flex flex-row justify-content-end">
                        {{ Form::submit(__('messages.save'),['class' => 'btn btn-success btn-admin'])}}
                        <a href="{{ url()->previous() }}" class="btn btn-warning ml-2 btn-admin">{{ __('messages.cancel') }}</a>
                    </div>
                </h3>
                <!-- end of form header -->

                <!-- messages area -->
                @include('partials._messages')

                <!-- form body -->
                <div class="info-block">
                    <div class="info-element-3">
                        {{ Form::label('goal_id',__('messages.goal'),['class' => 'mt-2 text-nowrap']) }}
                        {{ Form::select('goal_id', $goals, null, ['class' => 'form-control', 'required', 'placeholder' => 'Pick a goal...']) }}
                    </div>
                    <div class="info-element-3">
                        {{ Form::label('estate_type_id',__('messages.estate-type'),['class' => 'mt-2 text-nowrap']) }}
                        {{ Form::select('estate_type_id', $estateTypes, null, ['class' => 'form-control', 'required', 'placeholder' => 'Pick an estate type...']) }}
                    </div>
                    <div class="info-element-3">
                        {{ Form::label('realtor_id',__('messages.realtor'),['class' => 'mt-2 text-nowrap']) }}
                        {{ Form::select('realtor_id', $realtors, null, ['class' => 'form-control', 'placeholder' => 'Choose a realtor...']) }}
                    </div>
                </div>

                <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded font-weight-bold">
                    <h4>{{ __('messages.identification') }}</h4>
                    {{ Form::label('locations',__('messages.locations'),['class' => 'mt-2']) }}
                    {{ Form::select('locations[]', $locations, null, ['class' => 'form-control locations-select', 'multiple' => 'multiple']) }}

                    {{ Form::label('address',__('messages.address'),['class' => 'mt-2']) }}
                    {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter an address...'])}}
                    <div class="info-block">
                        <div class="info-element-2">
                            {{ Form::label('rooms',__('messages.rooms')) }}
                            {{ Form::text('rooms', null, ['class' => 'form-control', 'placeholder' => 'Enter number of rooms...'])}}
                        </div>
                        <div class="info-element-2">
                            {{ Form::label('floor',__('messages.floor')) }}
                            {{ Form::text('floor', null, ['class' => 'form-control', 'placeholder' => 'Enter a floor number...'])}}
                        </div>
                    </div>
                    <div class="info-block">
                        <div class="info-element-3">
                            {{ Form::label('total_square',__('messages.total-square')) }}
                            {{ Form::text('total_square', null, ['class' => 'form-control', 'placeholder' => 'Enter number of rooms...'])}}
                        </div>
                        <div class="info-element-3">
                            {{ Form::label('living_square',__('messages.living-square')) }}
                            {{ Form::text('living_square', null, ['class' => 'form-control', 'placeholder' => 'Enter a square...'])}}
                        </div>
                        <div class="info-element-3">
                            {{ Form::label('kitchen_square',__('messages.kitchen-square')) }}
                            {{ Form::text('kitchen_square', null, ['class' => 'form-control', 'placeholder' => 'Enter a floor number...'])}}
                        </div>
                    </div>
                    <div class="info-block">
                        <div class="info-element-3">
                            {{ Form::label('bathroom',__('messages.bathroom')) }}
                            {{ Form::text('bathroom', null, ['class' => 'form-control', 'placeholder' => 'Enter number of rooms...'])}}
                        </div>
                        <div class="info-element-3">
                            {{ Form::label('balcony',__('messages.balcony')) }}
                            {{ Form::text('balcony', null, ['class' => 'form-control', 'placeholder' => 'Enter a square...'])}}
                        </div>
                        <div class="info-element-3">
                            {{ Form::label('loggia',__('messages.loggia')) }}
                            {{ Form::text('loggia', null, ['class' => 'form-control', 'placeholder' => 'Enter a floor number...'])}}
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-column mt-2">
                        {{ Form::label('condition',__('messages.condition'),['class' => 'mt-2']) }}
                        {{ Form::textarea('condition', null, ['class' => 'form-control', 'rows' => 5])}}
                    </div>
                </div>

                <div class="col-12 d-flex flex-column p-2 justify-content-between m-1 mt-2 border border-danger rounded font-weight-bold">
                    <h4>{{ __('messages.prices') }}</h4>
                    <div class="info-block">
                        <div class="info-element-3">
                            {{ Form::label('price',__('messages.price')) }}
                            {{ Form::text('price', null, ['class' => 'form-control text-primary font-weight-bold', 'placeholder' => 'Enter a wanted price...'])}}
                        </div>
                        <div class="info-element-3">
                            {{ Form::label('min_price',__('messages.minimal-price'), ['class' => 'text-nowrap']) }}
                            {{ Form::text('min_price', null, ['class' => 'form-control text-danger font-weight-bold', 'placeholder' => 'Enter a possibly minimal price...'])}}
                        </div>
                        <div class="info-element-3">
                            {{ Form::label('final_price',__('messages.final-price'), ['class' => 'text-nowrap']) }}
                            {{ Form::text('final_price', null, ['class' => 'form-control text-success font-weight-bold', 'placeholder' => 'Enter a possibly minimal price...'])}}
                        </div>
                    </div>
                </div>

                <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded font-weight-bold">
                    <h4>{{ __('messages.ad-info') }}</h4>
                    {{ Form::label('title',__('messages.title'),['class' => 'mt-2']) }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter an address...'])}}

                    {{ Form::label('description',__('messages.description'),['class' => 'mt-2']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5])}}

                    {{ Form::label('main_image',__('messages.image'),['class' => 'h4'])}}
                    {{ Form::file('main_image') }}
                </div>

                {{ Form::label('object_info',__('messages.object-info'),['class' => 'h4 mt-2']) }}
                {{ Form::textarea('object_info', null, ['class' => 'form-control', 'rows' => 5])}}

                {{ Form::label('owner_info',__('messages.owner'),['class' => 'h4 mt-2']) }}
                {{ Form::textarea('owner_info', null, ['class' => 'form-control', 'rows' => 5])}}

                {{ Form::label('final_info',__('messages.final-info'),['class' => 'h4 mt-2']) }}
                {{ Form::textarea('final_info', null, ['class' => 'form-control', 'rows' => 5])}}

                <!-- end of form body -->

                <!-- form footer -->
                <h3 class="d-flex flex-row justify-content-between mt-2">
                    <span>&nbsp;</span>
                    <div class="d-flex flex-row">
                        {{ Form::submit(__('messages.save'),['class' => 'btn btn-success btn-admin'])}}
                        <a href="{{ url()->previous() }}" class="btn btn-warning ml-2 btn-admin">{{ __('messages.cancel') }}</a>
                    </div>
                </h3>
            {{ Form::close() }}
            <!-- end of form footer-->
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
