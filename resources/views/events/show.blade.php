@extends('layouts.app')

@section('content')
    <div class="container text-center">

        <div class="panel panel-primary">

            <div class="panel-body mx-auto">

                @auth
                    {!! Form::open(['route' => ['events.update', $event], 'method'=>'PUT', 'files'=>'true']) !!}
                        <div class="col-xs-5 col-sm-5 col-md-5 mx-auto">
                            <div class="form-group">
                                {!! Form::label('event_title','Event Name:') !!}
                                <div class="">
                                    {!! Form::text('event_title', $event->event_title, ['class' => 'form-control']) !!}
                                    {!! $errors->first('event_title', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-5 col-sm-5 col-md-5 mx-auto">
                            <div class="form-group">
                                {!! Form::label('event_start_date','Start Date:') !!}
                                <div class="">
                                    {!! Form::date('event_start_date', $event->event_start_date, ['class' => 'form-control']) !!}
                                    {!! $errors->first('event_start_date', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-5 col-sm-5 col-md-5 mx-auto">
                            <div class="form-group">
                                {!! Form::label('event_end_date','End Date:') !!}
                                <div class="">
                                    {!! Form::date('event_end_date', $event->event_end_date, ['class' => 'form-control']) !!}
                                    {!! $errors->first('event_end_date', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-3 mx-auto">
                            {!! Form::submit('Edit',['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                            <a href="#" class="btn btn-danger"
                               onclick="
                                        var result = confirm('Are you sure you want to delete?');
                                        if (result) {
                                            event.preventDefault();
                                            document.getElementById('delete-form').submit();
                                        }"
                            >Delete</a>

                            <form id="delete-form" action="{{ route('events.destroy', [$event->id]) }}"
                                  method="post" style="display: none;">
                                <input type="hidden" name="_method" value="delete">
                                {{ csrf_field() }}
                            </form>

                    @endauth

                    @guest

                        <div class="col-xs-5 col-sm-5 col-md-5 mx-auto">
                            <h4 style="color:red">You cannot edit an event if you're not authorized!</h4>
                            <div class="form-group">
                                <ul class="list-group">
                                    <li class="list-group-item">{{ $event->event_title }}</li>
                                    <li class="list-group-item">{{ $event->event_start_date }}</li>
                                    <li class="list-group-item">{{ $event->event_end_date }}</li>
                                </ul>
                            </div>
                        </div>

                    @endguest

                    <a href="{{ url('/') }}" class="btn btn-secondary">Go back</a>

                </div>
            </div>
        </div>
    </div>
@endsection