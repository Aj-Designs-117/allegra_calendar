<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Event;
use Illuminate\Http\Request;

class TaskProgramController extends Controller
{
    public function removeAppointmentsDaily()
    {
        // Recuperar los cupos originales de las citas
        $quotasOriginals = Event::pluck('limited_quotas', 'id');

        // Borrar clases del día
        Appointment::whereDate('date', now()->toDateString())->delete();

        // Restablecer los cupos de las citas a su estado original
        foreach ($quotasOriginals as $quotaId => $quotaOriginal) {
            Event::where('id', $quotaId)->update(['limited_quotas' => $quotaOriginal]);
        }

        // Puedes agregar lógica adicional según tus necesidades

        return response()->json(['message' => 'Tareas programadas ejecutadas con éxito']);
    }
}
