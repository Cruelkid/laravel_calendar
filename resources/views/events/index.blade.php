@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="panel panel-primary">

            <div class="panel-heading text-center">Event creation:</div>

            <div class="panel-body">

                {!! Form::open(array('route' => 'events.create','method'=>'POST','files'=>'true')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @elseif (Session::has('warning'))
                            <div class="alert alert-danger">{{ Session::get('warning') }}</div>
                        @endif

                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('event_title','Event Name:') !!}
                            <div class="">
                                {!! Form::text('event_title', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('event_title', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::label('event_start_date','Start Date:') !!}
                            <div class="">
                                {!! Form::date('event_start_date', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('event_start_date', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::label('event_end_date','End Date:') !!}
                            <div class="">
                                {!! Form::date('event_end_date', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('event_end_date', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                        {!! Form::submit('Add Event',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

        </div>

        <div class="panel panel-primary">
            <div class="panel-heading text-center">Events:</div>
            <div class="panel-body">
                {!! $calendar_details->calendar() !!}
            </div>
        </div>

    </div>
@endsection

@section('calendar')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <script>
        @yield('pageScript')
    </script>
    {!! $calendar_details->script() !!}
@endsection