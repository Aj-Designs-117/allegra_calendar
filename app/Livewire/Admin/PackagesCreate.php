<?php

namespace App\Livewire\Admin;

use App\Models\Package;
use Livewire\Component;

class PackagesCreate extends Component
{
    public $id, $description, $price, $class;

    public function render()
    {
        return view('livewire.admin.packages-create');
    }

    public function resetFields()
    {
        $this->description = '';
        $this->price = '';
        $this->class = '';
    }

    public function store()
    {
        $this->validate([
            'description' => 'required',
            'price' => 'required',
            'class' => 'required',
        ]);

        try {
            Package::create([
                'description' => $this->description,
                'price' => $this->price,
                'class' => $this->class,
            ]);

            $this->resetFields();
            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear un nuevo paquete']);
            $this->resetFields();
        }
    }
}
