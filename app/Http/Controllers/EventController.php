<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::get();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->event_title,
                true,
                new \DateTime($event->event_start_date),
                new \DateTime($event->event_end_date . ' +1 day'),
                null,
                [
                    'url' => $event->id
                ]
            );
        }

        $calendar_details = Calendar::addEvents($event_list);

        return view('events.index', compact('calendar_details'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_title' => 'required',
            'event_start_date' => 'required',
            'event_end_date' => 'nullable|after_or_equal:event_start_date'
        ]);

        if ($validator->fails()) {
            \Session::flash('warning', 'Enter valid credentials');
            return Redirect::to('/')->withInput()->withErrors($validator);
        }

        $event = new Event();
        $event->event_title = $request['event_title'];
        $event->event_start_date = $request['event_start_date'];
        $event->event_end_date = empty($request['event_end_date']) ? $request['event_start_date'] : $request['event_end_date'];
        $event->save();

        \Session::flash('success', 'Event created successfully!');
        return Redirect::to('/');

    }

    public function show(Event $event)
    {
        $event = Event::find($event->id);

        return view('events.show', [
            'event' => $event
        ]);
    }

    public function destroy(Event $event)
    {
        $eventDelete = Event::find($event->id);

        if ($eventDelete->delete()) {
            return redirect()->route('events')
                ->with('success', 'Event deleted succesfully!');
        }

        return back()->withInput()->with('warning', 'Event cannot be deleted.');
    }

    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'event_end_date' => 'nullable|after_or_equal:event_start_date'
        ]);

        if ($validator->fails()) {
            \Session::flash('warning', 'Enter valid credentials');
            return Redirect::to($event->id)->withInput()->withErrors($validator);
        }

        $eventUpdate = Event::where('id', $event->id)->update([
            'event_title' => $request->input('event_title'),
            'event_start_date' => $request->input('event_start_date'),
            'event_end_date' => $request->input('event_end_date')
        ]);

        if ($eventUpdate) {
            return redirect()->route('events')
                ->with('success', 'Event updated successfully!');
        }

        return back()->withInput();
    }

}
