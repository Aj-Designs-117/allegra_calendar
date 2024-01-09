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
        $subscriptions = Subscription::with('package')->where('user_id', $user->id)
            ->select('limit_class', 'status', 'start_date', 'end_date', 'package_id')
            ->firstOrNew();
        return view('dashboard', compact('subscriptions'));
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
                'daysOfWeek' => $event->daysOfWeek,
                'startTime' => $event->startTime,
                'endTime' => $event->endTime,
            ];
        }

        return response()->json($events);
    }

    public function show($id, $date)
    {
        try {
            $event = Event::select('id', 'title', 'startTime', 'max_quotas')->findOrFail($id);
            $event->time = Carbon::parse($event->startTime)->format('H:i');
            $total_appointment_quotas = $event->max_quotas;

            if (Appointment::where('event_id', $id)->whereDate('date', $date)->exists()) {
                $appointment_quotas = Appointment::where('event_id', $id)->whereDate('date',  $date)->count();
                $total_appointment_quotas = $event->max_quotas - $appointment_quotas;
            } else {
                $event_quota = Event::where('id', $id)->select('max_quotas')->firstOrFail();
                $total_appointment_quotas = $event_quota->max_quotas;
            }

            return response()->json([
                'event' => $event,
                'appointments_quotas' =>  $total_appointment_quotas,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo va con el horario.', $e]);
        }
    }
}
