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
    public $user_id, $id, $status, $class_limit, $description, $price;

    public function render()
    {
        $subscriptions = Subscription::whereNotIn('id', array_merge([1, 2]))->with('user')
            ->where(function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(15);
        return view('livewire.admin.subscriptions-index', compact('subscriptions'));
    }


    public function show_subscription($id)
    {
        $subscription = Subscription::find($id);
        $this->id = $subscription->id;
        $this->class_limit = $subscription->class_limit;
        $this->description = $subscription->description;
        $this->price = $subscription->price;
    }


    public function renew_subscription($id)
    {
        $this->validate([
            'description' => 'required',
            'price' => 'required',
            'class_limit' => 'required',
            'status' => 'required',
        ]);

        $this->validate(['status' => 'required']);

        try {
            $subscription = Subscription::select('status')->find($id);

            if ($subscription->status == 'Inactivo') {
                $startDate = now();
                $newEndDate = now()->addDays(30);

                Subscription::where('id', $id)->update([
                    'start_date' => $startDate,
                    'end_date' => $newEndDate,
                    'description' => $this->description,
                    'price' => $this->price,
                    'class_limit' => $this->class_limit,
                    'status' => $this->status,
                ]);

                $this->dispatch('success', ['message' => 'Tu suscripción ha sido renovada.']);
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

    public function destroy($id)
    {
        try {
            Subscription::find($id)->delete();
            $this->dispatch('success', ['message' => 'Se ha eliminado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al eliminar la suscripcion']);
        }
    }
}
