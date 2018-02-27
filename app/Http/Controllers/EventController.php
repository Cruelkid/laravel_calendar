<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index() {
        $events = Event::get();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->event_title,
                true,
                new \DateTime($event->event_start_date),
                new \DateTime($event->event_end_date.' +1 day')
            );
        }
        $calendar_details = Calendar::addEvents($event_list);

        return view('events', compact('calendar_details') );
    }

    public function addEvent(Request $request) {
        $validator = Validator::make($request->all(), [
            'event_title' => 'required',
            'event_start_date' => 'required'
        ]);

        if ($validator->fails()) {
            \Session::flash('warning', 'Enter valid credentials');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }

        $event = new Event();
        $event->event_title = $request['event_title'];
        $event->event_start_date = $request['event_start_date'];
        $event->event_end_date = empty($request['event_end_date']) ? $request['event_start_date'] : $request['event_end_date'];
        $event->save();

        \Session::flash('success', 'Event created successfully!');
        return Redirect::to('/events');

    }

}
