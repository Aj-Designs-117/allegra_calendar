<?php

namespace App\Livewire\Admin;

use App\Models\Package;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;

class SubscriptionsCreate extends Component
{
    public $description, $price, $limit_class, $status, $user_id, $package_id;

    public function render()
    {
        $users = User::whereNotIn('id', array_merge([1, 2]))->select('id', 'name')->get();
        $packages = Package::select('id','description')->get();
        $package_list = Package::select('description','price','class')->find($this->package_id);
        if ($package_list) {
            $this->description = $package_list->description;
            $this->price = $package_list->price;
            $this->limit_class = $package_list->class;
        }

        return view('livewire.admin.subscriptions-create', compact('users', 'packages')); 
    }

    public function store()
    { 
        $this->validate([
            'limit_class' => 'required',
            'status' => 'required',
            'user_id' =>'required',
            'package_id' => 'required'
        ]);

        try {
            $startDate = now();
            $endDate = now()->addDays(30);

            Subscription::create([
                'limit_class' => $this->limit_class,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => $this->status,
                'user_id' => $this->user_id,
                'package_id' => $this->package_id,
            ]);

            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear una nueva suscripcion']);
        }
    }
}
