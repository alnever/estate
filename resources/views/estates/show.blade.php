@extends('layouts.admin')

@section('title', '| Estates')

@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <!-- form header -->
            <h3 class="estate-show-header">
                <span>{{ __('messages.estate') }} {{ $estate->address }}</span>
                <div class="d-flex flex-row justify-content-end">
                    <a href="{{ route('estates.edit', [app()->getLocale(), $estate->id]) }}" class="btn btn-primary ml-2 btn-admin">{{ __('messages.edit') }}</a>
                    {{ Form::open(['route' => ['estates.destroy', app()->getLocale(), $estate->id], 'method' => 'DELETE']) }}
                        {{ Form::submit(__('messages.delete'),['class' => 'btn btn-danger btn-admin ml-2']) }}
                    {{ Form::close() }}
                    <a href="{{ route('estates.index', app()->getLocale()) }}" class="btn btn-warning ml-2 btn-admin">{{ __('messages.back') }}</a>
                </div>
            </h3>
            <!-- end of form header -->

            <!-- messages area -->
            @include('partials._messages')

            <!-- form body -->
            <div class="estate-show-parameters p-2 m-1 mt-2 border border-info rounded">
                <div>
                    <span>{{ __('messages.goal') }}</span> <strong>{{ __('messages.'.$estate->goal->name) }}</strong>
                </div>
                <div>
                    <span>{{ __('messages.estate-type') }}</span> <strong>{{ $estate->estateType->name }}</strong>
                </div>
                <div>
                    @if ($estate->realtor)
                        <span>{{ __('messages.realtor') }}</span> <strong>{{ $estate->realtor->name }}</strong>
                    @endif
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded">
                <h4>{{ __('messages.identification') }}</h4>
                <strong>{{ __('messages.locations') }}</strong>
                <h4>
                    @foreach ($estate->locations as $location)
                        <span class=" badge badge-secondary">{{ $location->name }}</span>
                    @endforeach
                </h4>

                <div class="estate-show-parameters mt-2">
                    <div>
                        <span>{{ __('messages.rooms') }}</span> <strong>{{ $estate->rooms }}</strong>
                    </div>
                    <div>
                        <span>{{ __('messages.floor') }}</span> <strong>{{ $estate->floor }}</strong>
                    </div>
                </div>
                <div class="estate-show-parameters mt-2">
                    <div>
                        <span>{{ __('messages.total-square') }}</span> <strong>{{ $estate->total_square }}</strong>
                    </div>
                    <div>
                        <span>{{ __('messages.living-square') }}</span> <strong>{{ $estate->living_square }}</strong>
                    </div>
                    <div>
                        <span>{{ __('messages.kitchen-square') }}</span> <strong>{{ $estate->kitchen_square }}</strong>
                    </div>
                </div>
                <div class="estate-show-parameters mt-2">
                    <div>
                        <span>{{ __('messages.bathroom') }}</span> <strong>{{ $estate->bathroom }}</strong>
                    </div>
                    <div>
                        <span>{{ __('messages.balcony') }}</span> <strong>{{ $estate->balcony }}</strong>
                    </div>
                    <div>
                        <span>{{ __('messages.loggia') }}</span> <strong>{{ $estate->loggia }}</strong>
                    </div>
                </div>
                <div class="d-flex flex-column mt-2">
                    <strong>{{ __('messages.condition') }}</strong>
                    <p>
                        {!! $estate->condition !!}
                    </p>
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 justify-content-between m-1 mt-2 border border-danger rounded">
                <h4>{{ __('messages.prices') }}</h4>
                <div class="estate-show-parameters p-2 m-1 mt-2 font-weight-bold">
                    <div>
                        <span>{{ __('messages.price') }}</span> <strong class="text-primary">{{ $estate->price }}</strong>
                    </div>
                    <div>
                        <span>{{ __('messages.minimal-price') }}</span> <strong class="text-danger">{{ $estate->min_price }}</strong>
                    </div>
                    <div>
                        <span>{{ __('messages.final-price') }}</span> <strong class="text-success">{{ $estate->final_price }}</strong>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded">
                <h4>{{ __('messages.ad-info') }}</h4>
                <div class="estate-ad-info">
                    <div class="estate-image">
                        <img src="{{ asset('uploads/images/' . $estate->main_image) }}" alt="" class='info-image'>
                    </div>
                    <div class="estate-description">
                        <h5>{{ $estate->title }}</h5>
                        <p>
                            {!! $estate->description !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex flex-column p-2 m-1 mt-2 border border-info rounded">
                <h4>{{ __('messages.additional-info') }}</h4>
                <div class="d-flex flex-column mt-2">
                    <strong>{{ __('messages.object-info') }}</strong>
                    <p>
                        {!! $estate->object_info !!}
                    </p>
                </div>

                <div class="d-flex flex-column mt-2">
                    <strong>{{ __('messages.owner') }}</strong>
                    <p>
                        {!! $estate->owner_info !!}
                    </p>
                </div>

                <div class="d-flex flex-column mt-2">
                    <strong>{{ __('messages.final-info') }}</strong>
                    <p>
                        {!! $estate->final_info !!}
                    </p>
                </div>
            </div>

            <!-- form footer -->
            <h3 class="d-flex flex-row justify-content-between mt-2">
                <span>&nbsp;</span>
                <div class="d-flex flex-row">
                    <a href="{{ route('estates.edit', [app()->getLocale(), $estate->id]) }}" class="btn btn-primary ml-2 btn-admin">{{ __('messages.edit') }}</a>
                    {{ Form::open(['route' => ['estates.destroy', app()->getLocale(), $estate->id], 'method' => 'DELETE']) }}
                        {{ Form::submit(__('messages.delete'),['class' => 'btn btn-danger btn-admin ml-2']) }}
                    {{ Form::close() }}
                    <a href="{{ route('estates.index', app()->getLocale()) }}" class="btn btn-warning ml-2 btn-admin">{{ __('messages.back') }}</a>
                </div>
            </h3>
        </div>
    </div>

@endsection
