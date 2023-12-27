<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Event;
use Illuminate\Console\Command;

class RemoveAppointmentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-appointments-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar registros del modelo Appointments con la fecha de hoy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Recuperar los cupos originales de las citas
        $quotasOriginals = Event::pluck('original_quotas', 'id');

        // Borrar clases del día
        Appointment::whereDate('date', now()->toDateString())->delete();

        // Restablecer los cupos de las citas a su estado original
        foreach ($quotasOriginals as $quotaId => $quotaOriginal) {
            Event::where('id', $quotaId)->update(['limited_quotas' => $quotaOriginal]);
        }
    }
}
