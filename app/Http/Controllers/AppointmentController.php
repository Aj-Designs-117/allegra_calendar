<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Event;
use App\Models\Record;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Auth::user()->appointments()->where('date', '>=', Carbon::now()->toDateString())->get();
        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        try {
            $user = auth()->user();
            $subscription = Subscription::where('user_id', $user->id)->with('package')->latest()->first();

            /** Checa que el usuario tenga una suscripcion activa **/
            if (!$subscription || ($subscription->status == '')) {
                return response()->json(['warning' => 'Aun no tienes una suscripción.']);
            }

            /** Checa que el usuario aun tenga vigencia de la suscripcion, despues de 30 dias expira la suscripcion  **/
            if ($subscription->end_date <= Carbon::now()->toDateString()) {
                $subscription->update(['status' => 'Inactivo']);
                return response()->json(['warning' => 'Tu suscripción ha expirado.']);
            }

            /** Checa el status del usuario  **/
            if ($subscription->status == 'Inactivo') {
                return response()->json(['warning' => 'Tu suscripción ha quedado suspendida.']);
            }

            /** Verifica si el campo class_limit ya agoto las clases y expira la suscripcion **/
            if ($subscription->limit_class == 0) {
                $subscription->update(['status' => 'Inactivo']);
                return response()->json(['warning' => 'Has agotado tus clases tu suscripción ha expirado.']);
            }

            $date_expiration = Carbon::parse($request->date);
            // Verificar si la fecha de la cita está dentro del periodo de vencimiento (30 días)
            if ($date_expiration->diffInDays(now()) >= 29) {
                return response()->json(['warning' => 'La clase no puede ser programada con más de 30 días de anticipación.']);
            }

            /** Checa que el usuario no vuelva a agendar el mismo evento  **/
            $appointment_made = $user->appointments()->where('event_id', $request->id)->whereDate('date', $request->date)->exists();
            if ($appointment_made) {
                return response()->json(['warning' => 'Ya agendo esta clase.']);
            }

            $existingAppointments = Appointment::where('event_id', $request->id)->whereDate('date', $request->date)->count();
            $event = Event::where('id', $request->id)->select('id', 'max_quotas')->firstOrFail();

            if ($request->date >= Carbon::now()->toDateString()) {

                if ($existingAppointments < $event->max_quotas) {

                    $current_time = date('H:i');
                    // Verificar que la hora actual esté en el rango permitido
                    if (!$this->timeValidation($current_time)) {
                        return response()->json(['warning' => 'Ya no puede agendar despues de las 10:00 pm.']);
                    } 

                    Appointment::create([
                        'title' => $request->title,
                        'date' => $request->date,
                        'time' => $request->time,
                        'event_id' => $request->id,
                        'available_quotas' => 1,
                        'user_id' => Auth::id(),
                    ]);

                    Record::create([
                        'title' => $request->title,
                        'date' => $request->date,
                        'time' => $request->time,
                        'user_id' => Auth::id(),
                    ]);

                    $subscription->update(['limit_class' => $subscription->limit_class - 1]);

                    return response()->json(['success' => 'Se ha agendado correctamente :)']);
                } else {
                    return response()->json(['warning' => 'El cupo para este dia esta lleno :(']);
                }
            } else {
                return response()->json(['warning' => 'No se puede agendar este dia.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo va mal al agendar.', $e]);
        }
    }

    private function timeValidation($time)
    {
        return ($time >= '06:00' && $time < '22:00');
    }

    public function destroy($id, $user_id)
    {
        try {
            $subscription = Subscription::where('user_id', $user_id)->firstOrFail();
            $appointment = Appointment::where('id', $id)->firstOrFail();

            // Obtener la fecha y hora actual
            $now = Carbon::now();
            $start_class = Carbon::parse($appointment->date . ' ' . $appointment->time);

            // Verificar si la cita es para el día actual
            if ($now->isSameDay($start_class)) {
                // Verificar si la hora actual es al menos una hora antes del inicio de la clase
                if ($now->diffInHours($start_class) > 1) {
                    // Si es así, eliminar el registro
                    $appointment->delete();
                    $subscription->update(['limit_class' => $subscription->limit_class + 1]);
                    return response()->json(['success' => 'Se ha borrado correctamente.']);
                } else {
                    // Si no es una hora antes del inicio de la clase, mostrar un mensaje de error
                    return response()->json(['warning' => 'No puedes eliminar la clase una hora antes del inicio de la clase.']);
                }
            } else {
                // La cita es para otro día, eliminar sin restricciones de tiempo
                $appointment->delete();
                $subscription->update(['limit_class' => $subscription->limit_class + 1]);
                return response()->json(['success' => 'Se ha borrado correctamente.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo va mal al borrar']);
        }
    }
}
