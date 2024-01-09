<?php

namespace App\Livewire\Admin;

use App\Models\Subscription;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class SubscriptionsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $user_id, $id, $status, $limit_class, $description, $price, $subscriptionId;

    public function render()
    {
        $subscriptions = Subscription::whereNotIn('id', array_merge([1, 2]))->with('user')
            ->with(['user', 'package'])
            ->where(function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(15);

        return view('livewire.admin.subscriptions-index', compact('subscriptions'));
    }


    public function show_subscription($id)
    {
        $subscription = Subscription::where('id', $id)->with('package')->first();
        $this->id = $subscription->id;
        $this->limit_class = $subscription->package->class;
        $this->description = $subscription->package->description;
        $this->price = $subscription->package->price;
    }


    public function renew_subscription($id)
    {
        $this->validate(['status' => 'required']);

        try {
            $subscription = Subscription::select('status')->where('id', $id)->firstOrFail();

            if ($subscription->status == 'Inactivo') {
                // $startDate = now();
                $newEndDate = now()->addDays(30);

                Subscription::where('id', $id)->update([
                    // 'start_date' => $startDate,
                    'end_date' => $newEndDate,
                    'status' => $this->status,
                ]);

                $this->dispatch('success', ['message' => 'La suscripción ha sido renovada.']);
                $this->dispatch('close-modal');
            } else {
                Subscription::where('id', $id)->update([
                    'status' => $this->status,
                ]);
                $this->dispatch('success', ['message' => 'El estatus ha sido actualizado.']);
                $this->dispatch('close-modal');
            }
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al renovar la suscripción.']);
        }
    }

    
    public function confirmDestroy($id)
    {
        $this->subscriptionId = $id;
        $this->dispatch('confirmDeleteAppointments', [
            'message' => '¿Estás seguro?',
            'confirmButtonText' => 'Sí, eliminarlo',
        ]);
    }

    public function destroy()
    {
        try {
            Subscription::where('id', $this->subscriptionId)->firstOrFail()->delete();
            $this->dispatch('success', ['message' => 'Se ha eliminado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al eliminar la suscripcion']);
        }
    }
}
