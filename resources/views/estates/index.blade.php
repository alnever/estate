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
            <div class="col-12 d-flex flex-column border border-secondary rounded bg-light p-2 mb-2">
                <h4>Search parameters:</h4>
                {{ Form::open(['route' => ['estates.index', app()->getLocale()], 'method' => 'GET']) }}
                    <div class="row d-flex flex-row p-2 text-nowrap">
                        <div class="col-4 d-flex flex-row justify-content-between p-2 align-items-center">
                            <h5 class="text-primary m-0 mr-2">Estates for:</h5>
                            {{ Form::label('sell','Sell',['class'=>'form-check-label']) }}
                            {{ Form::checkbox('sell',1, (isset($params['sell']) ? $params['sell'] : 1), ['class' => 'form-control']) }}
                            {{ Form::label('rent','Rent',['class'=>'form-check-label']) }}
                            {{ Form::checkbox('rent',1, (isset($params['rent']) ? $params['rent'] : 1), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-4 d-flex flex-row justify-content-between p-2 align-items-center">
                            <h5 class="text-primary m-0 mr-2">Estates status:</h5>
                            {{ Form::label('published','New',['class'=>'form-check-label']) }}
                            {{ Form::checkbox('published',1, (isset($params['published']) ? $params['published'] : 1), ['class' => 'form-control']) }}
                            {{ Form::label('process','In process',['class'=>'form-check-label']) }}
                            {{ Form::checkbox('process',1, (isset($params['process']) ? $params['process'] : 1), ['class' => 'form-control']) }}
                            {{ Form::label('sold','Sold',['class'=>'form-check-label']) }}
                            {{ Form::checkbox('sold',1, (isset($params['sold']) ? $params['sold'] : 1), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-4 d-flex flex-row justify-content-between p-2 align-items-center">
                            <h5 class="text-primary m-0 mr-2">Realtor:</h5>
                            {{ Form::select('realtor',$realtors,(isset($param['realtor']) ? $param['realtor'] : null), ['class' => 'form-control','placeholder' => 'Select a realtor...']) }}
                        </div>
                    </div>

                    <div class="row d-flex flex-row p-2 text-nowrap">
                        <div class="col-12 d-flex flex-row justify-content-berween p-2 align-items-center">
                            {{ Form::label('locations','Locations:',['class' => 'h5 text-primary m-0 mr-2'])}}
                            {{ Form::select('locations[]',$locations, (isset($params['locations']) ? $params['locations'] : null), ['class' => 'form-control locations-select', 'multiple' => 'multiple']) }}
                        </div>
                    </div>

                    <div class="row d-flex flex-row p-2 text-nowrap">
                        <div class="col-6 d-flex flex-row justify-content-berween p-2 align-items-center">
                            {{ Form::label('min_price','Minimal price:',['class' => 'h5 text-primary m-0 mr-2'])}}
                            {{ Form::text('min_price',(isset($params['min_price']) ? $params['min_price'] : null), ['class' => 'form-control', 'placeholder' => 'Enter minimal price...']) }}
                        </div>
                        <div class="col-6 d-flex flex-row justify-content-berween p-2 align-items-center">
                            {{ Form::label('max_price','Maximal price:',['class' => 'h5 text-primary m-0 mr-2'])}}
                            {{ Form::text('max_price',(isset($params['max_price']) ? $params['max_price'] : null), ['class' => 'form-control', 'placeholder' => 'Enter maximal price...']) }}
                        </div>
                    </div>

                    <div class="row d-flex flex-row p-2 text-nowrap">
                        <div class="col-3 d-flex flex-row justify-content-berween p-2 align-items-center">
                            {{ Form::label('deleted','Show deleted objects',['class' => 'h5 text-danger m-0'])}}
                            {{ Form::checkbox('deleted',1, (isset($params['deleted']) ? $params['deleted'] : 0), ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row d-flex flex-row p-2 text-nowrap">
                        <div class="col-12 text-center">
                            {{ Form::submit('Search',['class' => 'btn btn-secondary btn-admin']) }}
                        </div>
                    </div>

                {{ Form::close() }}
            </div>
            <!-- end of search form -->

            <!-- messages area -->
            @include('partials._messages')
            <!-- should be table -->
            <table class="table">
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
                                @if ($estate->trashed())
                                    <a href="{{ route('estates.restore', [app()->getLocale(), $estate->id]) }}" class="btn btn-outline-success">Restote</a>
                                @else
                                    {{ $estate->stage->name }}
                                @endif
                            </td>
                            <td>
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
                            <td class="text-success font-weight-bold">
                                {{ $estate->final_price }}
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
