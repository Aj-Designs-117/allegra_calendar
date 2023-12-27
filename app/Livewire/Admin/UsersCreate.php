<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersCreate extends Component
{
    public $id, $name, $email, $password;

    public function render()
    {
        return view('livewire.admin.users-create');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function store()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string'
        ]);

        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            $this->resetFields();
            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear un nuevo usuario']);
            $this->resetFields();
        }
    }
}
