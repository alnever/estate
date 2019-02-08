@extends('layouts.admin')

@section('title', '| Estates')

@section('styles')
    <!-- for select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <h3 class="d-flex flex-row justify-content-between">
                <span>{{ __('messages.estates') }}</span>
                <a href="{{ route('estates.create', app()->getLocale()) }}" class="btn btn-success">{{ __('messages.add-new-estate') }}</a>
            </h3>
            <!-- search form -->
            <div class="search-form mb-2">
                <h4>{{ __('messages.search-title') }}</h4>
                {{ Form::open(['route' => ['estates.index', app()->getLocale()], 'method' => 'GET']) }}
                    <div class="block-1">
                        <div class="element-group">
                            <h5 class="text-primary m-0 mr-2">{{ __('messages.search-goal') }}</h5>
                            <div class="element-with-label">
                                {{ Form::label('sell',__('messages.sell'),['class'=>'form-check-label']) }}
                                {{ Form::checkbox('sell',1, (isset($params['sell']) ? $params['sell'] : 1), ['class' => 'form-control']) }}
                            </div>
                            <div class="element-with-label">
                                {{ Form::label('rent',__('messages.rent'),['class'=>'form-check-label']) }}
                                {{ Form::checkbox('rent',1, (isset($params['rent']) ? $params['rent'] : 1), ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="element-group">
                            <h5 class="text-primary m-0 mr-2">{{ __('messages.search-status') }}</h5>
                            <div class="element-with-label">
                                {{ Form::label('process',__('messages.process'),['class'=>'form-check-label']) }}
                                {{ Form::checkbox('process',1, (isset($params['process']) ? $params['process'] : 1), ['class' => 'form-control']) }}
                            </div>
                            <div class="element-with-label">
                                {{ Form::label('sold',__('messages.sold'),['class'=>'form-check-label']) }}
                                {{ Form::checkbox('sold',1, (isset($params['sold']) ? $params['sold'] : 1), ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="element-group">
                            <div class="element-with-label">
                                <h5 class="text-primary m-0 mr-2">{{ __('messages.search-realtor') }}</h5>
                                {{ Form::select('realtor',$realtors,(isset($param['realtor']) ? $param['realtor'] : null), ['class' => 'form-control','placeholder' => __('messages.placeholder-realtor')]) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                        <div class="element-group">
                            <div class="element-with-label">
                                {{ Form::label('locations',__('messages.locations'),['class' => 'h5 text-primary m-0 mr-2'])}}
                                {{ Form::select('locations[]',$locations, (isset($params['locations']) ? $params['locations'] : null), ['class' => 'form-control locations-select', 'multiple' => 'multiple']) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                        <div class="element-group">
                            <div class="element-with-label">
                                {{ Form::label('min_price',__('messages.form-min-price'),['class' => 'h5 text-primary m-0 mr-2'])}}
                                {{ Form::text('min_price',(isset($params['min_price']) ? $params['min_price'] : null), ['class' => 'form-control', 'placeholder' => __('messages.placeholder-min-price')]) }}
                            </div>
                            <div class="element-with-label">
                                {{ Form::label('max_price',__('messages.form-max-price'),['class' => 'h5 text-primary m-0 mr-2'])}}
                                {{ Form::text('max_price',(isset($params['max_price']) ? $params['max_price'] : null), ['class' => 'form-control', 'placeholder' => __('messages.placeholder-max-price')]) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                        <div class="element-group">
                            <div class="element-with-label">
                                {{ Form::label('deleted',__('messages.show-deleted'),['class' => 'h5 text-danger'])}}
                                {{ Form::checkbox('deleted',1, (isset($params['deleted']) ? $params['deleted'] : 0), ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                            {{ Form::submit(__('messages.search'),['class' => 'btn btn-secondary btn-admin']) }}
                    </div>

                {{ Form::close() }}
            </div>
            <!-- end of search form -->

            <!-- messages area -->
            @include('partials._messages')
            <!-- should be table -->
            <table class="table estate-list">
                <thead>
                    <th width="3%">#</th>
                    <th width="5%">{{ __('messages.goal') }}</th>
                    <th width="5%">{{ __('messages.stage') }}</th>
                    <th width="25%">{{ __('messages.description') }}</th>
                    <th width="15%">{{ __('messages.owner') }}</th>
                    <th width="10%">{{ __('messages.location') }}</th>
                    <th width="10%">{{ __('messages.price') }}</th>
                    <th width="12%">{{ __('messages.minimal-price') }}</th>
                    <th width="10%">{{ __('messages.final-price') }}</th>
                    <th width="5%">{{ __('messages.realtor') }}</th>
                </thead>
                <tbody>
                    @foreach ($estates as $estate)
                        <tr class="{{ $estate->stage_id == 1 ? 'new-estate' : ($estate->stage_id == 2 ? 'estate-in-process' : 'sold-estate') }}">
                            <td class="estate-display-optional">{{ $estate->id }}</td>
                            <td class="estate-display-optional">{{ __('messages.'.$estate->goal->name) }}</td>
                            <td class="estate-display-optional">
                                @if ($estate->trashed())
                                    <a href="{{ route('estates.restore', [app()->getLocale(), $estate->id]) }}" class="btn btn-outline-success">{{ __('messages.restore' )}}</a>
                                @else
                                    {{ __('messages.'.$estate->stage->name) }}
                                @endif
                            </td>
                            <td class="estate-display-required">
                                @if ($estate->trashed())
                                    <h4 class="text-primary">{{ $estate->address }}</h4>
                                @else
                                    <a href="{{ route('estates.show', [app()->getLocale(), $estate->id]) }}" class="h4 text-primary">{{ $estate->address }}</a>
                                @endif

                                <p class="font-weight-bold">
                                    @if ($estate->rooms)
                                        <span class="estate-list-param">{{ __('messages.rooms') }} {{ $estate->rooms }}</span>
                                    @endif
                                    @if ($estate->floor)
                                        <span class="estate-list-param">{{ __('messages.floor') }}  {{ $estate->floor }}</span>
                                    @endif
                                </p>
                                <p>
                                    @if ($estate->total_square)
                                        <span class="estate-list-param">{{ __('messages.total-square') }} {{ $estate->total_square }}</span>
                                    @endif
                                    @if ($estate->living_square)
                                        <span class="estate-list-param">{{ __('messages.living-square') }} {{ $estate->living_square }}</span>
                                    @endif
                                    @if ($estate->kitchen_square)
                                        <span class="estate-list-param">{{ __('messages.kitchen-square') }} {{ $estate->kitchen_square }}</span>
                                    @endif
                                </p>
                                <p>
                                    @if ($estate->bathroom)
                                        <span class="estate-list-param">{{ __('messages.bathroom') }} {{ $estate->bathroom }}</span>
                                    @endif
                                    @if ($estate->balcony)
                                        <span class="estate-list-param">{{ __('messages.balcony') }} {{ $estate->balcony }}</span>
                                    @endif
                                    @if ($estate->loggia)
                                        <span class="estate-list-param">{{ __('messages.loggia') }} {{ $estate->loggia }}</span>
                                    @endif
                                </p>
                            </td>
                            <td class="estate-display-required">
                                {!! $estate->owner_info !!}
                            </td>
                            <td class="h5 estate-display-required">
                                @foreach ($estate->locations as $location)
                                    <span class="badge badge-secondary">{{ $location->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-primary font-weight-bold estate-display-required">
                                <span class="estate-label-optional">{{ __('messages.price') }}:</span> {{ $estate->price }}
                            </td>
                            <td class="text-danger font-weight-bold estate-display-required">
                                <span class="estate-label-optional">{{ __('messages.minimal-price') }}:</span> {{ $estate->min_price }}
                            </td>
                            <td class="text-success font-weight-bold estate-display-required">
                                <span class="estate-label-optional">{{ __('messages.final-price') }}:</span> {{ $estate->final_price }}
                            </td>
                            <td class="estate-display-optional">
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

@section('scripts')
    <!-- for select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
      $('.locations-select').select2();
    </script>
@endsection
