<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Event;
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
            'title' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        try {
            $user = auth()->user();
            $subscription = Subscription::where('user_id', $user->id)->latest()->first();

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

            /** Checa que el usuario no vuelva a agendar el mismo evento  **/
            $appointment_made = $user->appointments()->where('event_id', $request->id)->exists();
            if ($appointment_made) {
                return response()->json(['warning' => 'Ya agendo esta clase.']);
            }

            /** Verifica si el campo class_limit ya agoto las clases y expira la suscripcion **/
            if ($subscription->class_limit == 0) {
                $subscription->update(['status' => 'Inactivo']);
                return response()->json(['warning' => 'Has agotado tus clases tu suscripción ha expirado.']);
            }

            $date_expiration = Carbon::parse($request->date);
            // Verificar si la fecha de la cita está dentro del periodo de vencimiento (30 días)
            if ($date_expiration->diffInDays(now()) >= 30) {
                return response()->json(['warning' => 'La clase no puede ser programada con más de 30 días de anticipación.']);
            }

            /** Checa que el cupo de eventos del dia y agenda ese evento **/
            $limited_quotas = Event::findOrFail($request->id);
            if ($limited_quotas->limited_quotas > 0) {

                Appointment::create([
                    'event_id' => $request->id,
                    'title' => $request->title,
                    'date' => $request->date,
                    'time' => $request->time,
                    'user_id' => Auth::id(),
                ]);
                /** Decremento de los campos limited_quotas y class_limit **/
                $limited_quotas->update(['limited_quotas' => $limited_quotas->limited_quotas - 1]);
                $subscription->update(['class_limit' => $subscription->class_limit - 1]);

                return response()->json(['success' => 'Se ha agendado correctamente :)']);
            } else {
                return response()->json(['warning' => 'Lo siento! ya no hay cupos :(']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo va mal al agendar', $e]);
        }
    }

    public function destroy($id, $event_id, $user_id)
    {
        try {
            $subscription = Subscription::findOrFail($user_id);
            if ($subscription) {
                $subscription->update(['class_limit' => $subscription->class_limit + 1]);
            }
            $limited_quotas = Event::findOrFail($event_id);
            if ($limited_quotas) {
                $limited_quotas->update(['limited_quotas' => $limited_quotas->limited_quotas + 1]);
            }

            Appointment::findOrFail($id)->delete();

            return response()->json(['success' => 'Se ha borrado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo va mal al borrar']);
        }
    }
}
