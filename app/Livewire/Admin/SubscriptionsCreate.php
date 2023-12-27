<?php

namespace App\Livewire\Admin;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;

class SubscriptionsCreate extends Component
{
    public $description, $price, $class_limit, $status, $user_id;

    public function render()
    {
        $users = User::whereNotIn('id', array_merge([1, 2]))->select('id', 'name')->get();
        return view('livewire.admin.subscriptions-create', compact('users'));
    }

    public function resetFields()
    {
        $this->description = '';
        $this->price = '';
        $this->status = '';
        $this->class_limit = '';
    }

    public function store()
    {
        $this->validate([
            'description' => 'required',
            'price' => 'required',
            'class_limit' => 'required',
            'status' => 'required',
        ]);

        try {
            $startDate = now();
            $endDate = now()->addDays(30);

            Subscription::create([
                'description' => $this->description,
                'price' => $this->price,
                'class_limit' => $this->class_limit,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => $this->status,
                'user_id' => $this->user_id,
            ]);

            $this->resetFields();
            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear una nueva suscripcion']);
            $this->resetFields();
        }
    }
}
