@extends('layouts.front-end')

@section('title', '| Home')

@section('content')
    <!-- header -->
    <div class="header">
      <div class="row header-content">
        <div class="header-title">
            <h1 class="display-1 text-white">{{ __('messages.title') }}</h1>
            <h3 class="text-white">{{ __('messages.sub-title') }}</h3>
        </div>
        <div class="header-search-form">
            <div class="d-flex flex-column border border-light rounded bg-semi-light m-2 p-2">
                <h3 class="text-light">{{ __('messages.contact-realtor') }}</h3>
                <p class="text-white message-response">{{ __('messages.contact-motivation') }}</p>
                {!! Form::open(['route' => 'messages.store', 'method' => 'POST', 'name' => 'message-form', 'id' => 'message-form', 'class' => 'ajax']) !!}
                    {{ csrf_field() }}
                    {{ Form::hidden('estate_id', $estate->id) }}
                    <div class="mt-2">
                        {{ Form::label('email',__('messages.contact-email'), ['class' => 'h4 text-white'])}}
                        {{ Form::email('email',null, ['class' => 'form-control', 'placeholder' => 'Enter a valid email address...', 'required']) }}
                    </div>
                    <div class="mt-2">
                        {{ Form::label('message',__('messages.contact-message'), ['class' => 'h4 text-white'])}}
                        {{ Form::textarea('message',null, ['class' => 'form-control', 'rows' => 5, 'reuired']) }}
                    </div>
                    {{ Form::button(__('messages.send'), ['class' => 'btn btn-success btn-block mt-2', 'id' => 'message-send-button']) }}
                {!! Form::close() !!}
            </div>
        </div>
      </div>
    </div>

    <!-- main body -->
    <div class="container mt-2">
        <div class="estate-area">
            <div class="estate-image">
                <img src="{{ asset('uploads/images/' . $estate->main_image) }}" class="info-image"/>
            </div>
            <div class="estate-information-block">
                <h2>{{ $estate->title }}</h2>
                <h3>
                    @foreach ($estate->locations as $location)
                        <span class="badge badge-secondary">{{ $location->name }}</span>
                    @endforeach
                </h3>
                <div class="estate-price">
                    {{ $estate->price }} {{ __('messages.currency') }}
                </div>

                <div class="estate-properties">
                    <div class="properties-block">
                        <h4>{{ __('messages.parameters') }}</h4>
                        <div class="property">
                            <span class="property-title">{{ __('messages.rooms') }}</span>
                            <span class="property-value">{{ $estate->rooms }}</span>
                        </div>
                        <div class="property">
                            <span class="property-title">{{ __('messages.floor') }}</span>
                            <span class="property-value">{{ $estate->floor }}</span>
                        </div>
                    </div>

                    <div class="properties-block">
                        <h4>{{ __('messages.square') }}</h4>
                        <div class="property">
                            <span class="property-title">{{ __('messages.total-square') }}</span>
                            <span class="property-value">
                                {{ $estate->total_square }}
                                {!! __('messages.square-meter') !!}
                            </span>
                        </div>
                        <div class="property">
                            <span class="property-title">{{ __('messages.living-square') }}</span>
                            <span class="property-value">
                                {{ $estate->living_square }}
                                {!! __('messages.square-meter') !!}
                            </span>
                        </div>
                        <div class="property">
                            <span class="property-title">{{ __('messages.living-square') }}</span>
                            <span class="property-value">
                                {{ $estate->living_square }}
                                {!! __('messages.square-meter') !!}
                            </span>
                        </div>
                    </div>

                    <div class="properties-block">
                        <h4>{{ __('messages.facilities') }}</h4>
                        <div class="property">
                            <span class="property-title">{{ __('messages.bathroom') }}</span>
                            <span class="property-value">{{ $estate->bathroom }}</span>
                        </div>
                        <div class="property">
                            <span class="property-title">{{ __('messages.balcony') }}</span>
                            <span class="property-value">{{ $estate->balcony }}</span>
                        </div>
                        <div class="property">
                            <span class="property-title">{{ __('messages.loggia') }}</span>
                            <span class="property-value">{{ $estate->loggia }}</span>
                        </div>
                    </div>
                </div> <!-- end of .estate-properties -->
            </div>
        </div><!-- end of .estate-area -->

        <div class="estate-description">
            <h4>{{ __('messages.condition') }}</h4>
            <p>{!! $estate->condition !!}</p>
        </div>



        <div class="estate-description">
            <h4>{{ __('messages.information') }}</h4>
            <p>{!! $estate->description !!}</p>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#message-send-button').on('click',function() {
                $.ajaxSetup({
                    headers: {
                        'X-XSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/api/messages',
                    method: 'POST',
                    data: $('#message-form').serialize(),
                    success: function(data) {
                        $('.message-response').text(data.message);
                    },
                    error: function(data) {
                        $('.message-response').text(data.message);
                    }
                });
            });
        });
    </script>
@endsection
