<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Appointment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $subscription = Subscription::where('user_id', $user->id)
            ->select('description', 'price', 'class_limit', 'status', 'start_date', 'end_date')
            ->firstOrNew();;
        return view('dashboard', compact('subscription'));
    }

    public function create()
    {
        $all_events = Event::all();
        $events = [];
        foreach ($all_events as $event) {
            $events[] = [
                'id' => $event->id,
                'title' => $event->title,
                'color' => $event->color,
                'textColor' => $event->textColor,
                'start' => $event->start,
                'end' => $event->end,
                'daysOfWeek' => $event->daysOfWeek,
                'startTime' => $event->startTime,
                'endTime' => $event->endTime,
            ];
        }

        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::select('id', 'title', 'start', 'daysOfWeek', 'limited_quotas')->find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        // $event->date = Carbon::parse($event->start)->format('Y-m-d');
        $event->time = Carbon::parse($event->start)->format('H:i:s');
        unset($event->start);

        return response()->json($event);
    }
}
