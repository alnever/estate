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
                <span>Estates</span>
                <a href="{{ route('estates.create', app()->getLocale()) }}" class="btn btn-success">Add new estate</a>
            </h3>
            <!-- search form -->
            <div class="search-form mb-2">
                <h4>Search parameters:</h4>
                {{ Form::open(['route' => ['estates.index', app()->getLocale()], 'method' => 'GET']) }}
                    <div class="block-1">
                        <div class="element-group">
                            <h5 class="text-primary m-0 mr-2">Estates for:</h5>
                            <div class="element-with-label">
                                {{ Form::label('sell','Sell',['class'=>'form-check-label']) }}
                                {{ Form::checkbox('sell',1, (isset($params['sell']) ? $params['sell'] : 1), ['class' => 'form-control']) }}
                            </div>
                            <div class="element-with-label">
                                {{ Form::label('rent','Rent',['class'=>'form-check-label']) }}
                                {{ Form::checkbox('rent',1, (isset($params['rent']) ? $params['rent'] : 1), ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="element-group">
                            <h5 class="text-primary m-0 mr-2">Estates status:</h5>
                            <div class="element-with-label">
                                {{ Form::label('published','New',['class'=>'form-check-label']) }}
                                {{ Form::checkbox('published',1, (isset($params['published']) ? $params['published'] : 1), ['class' => 'form-control']) }}
                            </div>
                            <div class="element-with-label">
                                {{ Form::label('process','In process',['class'=>'form-check-label']) }}
                                {{ Form::checkbox('process',1, (isset($params['process']) ? $params['process'] : 1), ['class' => 'form-control']) }}
                            </div>
                            <div class="element-with-label">
                                {{ Form::label('sold','Sold',['class'=>'form-check-label']) }}
                                {{ Form::checkbox('sold',1, (isset($params['sold']) ? $params['sold'] : 1), ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="element-group">
                            <div class="element-with-label">
                                <h5 class="text-primary m-0 mr-2">Realtor:</h5>
                                {{ Form::select('realtor',$realtors,(isset($param['realtor']) ? $param['realtor'] : null), ['class' => 'form-control','placeholder' => 'Select a realtor...']) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                        <div class="element-group">
                            <div class="element-with-label">
                                {{ Form::label('locations','Locations:',['class' => 'h5 text-primary m-0 mr-2'])}}
                                {{ Form::select('locations[]',$locations, (isset($params['locations']) ? $params['locations'] : null), ['class' => 'form-control locations-select', 'multiple' => 'multiple']) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                        <div class="element-group">
                            <div class="element-with-label">
                                {{ Form::label('min_price','Minimal price:',['class' => 'h5 text-primary m-0 mr-2'])}}
                                {{ Form::text('min_price',(isset($params['min_price']) ? $params['min_price'] : null), ['class' => 'form-control', 'placeholder' => 'Enter minimal price...']) }}
                            </div>
                            <div class="element-with-label">
                                {{ Form::label('max_price','Maximal price:',['class' => 'h5 text-primary m-0 mr-2'])}}
                                {{ Form::text('max_price',(isset($params['max_price']) ? $params['max_price'] : null), ['class' => 'form-control', 'placeholder' => 'Enter maximal price...']) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                        <div class="element-group">
                            <div class="element-with-label">
                                {{ Form::label('deleted','Show deleted objects',['class' => 'h5 text-danger'])}}
                                {{ Form::checkbox('deleted',1, (isset($params['deleted']) ? $params['deleted'] : 0), ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div class="block-1">
                            {{ Form::submit('Search',['class' => 'btn btn-secondary btn-admin']) }}
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
                    <th width="5%">Goal</th>
                    <th width="5%">Stage</th>
                    <th width="25%">Estate Description</th>
                    <th width="15%">Owner information</th>
                    <th width="10%">Location</th>
                    <th width="10%">Price</th>
                    <th width="12%">Minimal Price</th>
                    <th width="10%">Final Price</th>
                    <th width="5%">Realtor</th>
                </thead>
                <tbody>
                    @foreach ($estates as $estate)
                        <tr class="{{ $estate->stage_id == 1 ? 'new-estate' : ($estate->stage_id == 2 ? 'estate-in-process' : 'sold-estate') }}">
                            <td class="estate-display-optional">{{ $estate->id }}</td>
                            <td class="estate-display-optional">{{ $estate->goal->name }}</td>
                            <td class="estate-display-optional">
                                @if ($estate->trashed())
                                    <a href="{{ route('estates.restore', [app()->getLocale(), $estate->id]) }}" class="btn btn-outline-success">Restote</a>
                                @else
                                    {{ $estate->stage->name }}
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
                            <td class="estate-display-required">
                                {!! $estate->owner_info !!}
                            </td>
                            <td class="h5 estate-display-required">
                                @foreach ($estate->locations as $location)
                                    <span class="badge badge-secondary">{{ $location->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-primary font-weight-bold estate-display-required">
                                <span class="estate-label-optional">Price:</span> {{ $estate->price }}
                            </td>
                            <td class="text-danger font-weight-bold estate-display-required">
                                <span class="estate-label-optional">Minimal Price:</span> {{ $estate->min_price }}
                            </td>
                            <td class="text-success font-weight-bold estate-display-required">
                                <span class="estate-label-optional">Final Price:</span> {{ $estate->final_price }}
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
