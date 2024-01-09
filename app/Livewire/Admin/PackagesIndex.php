<?php

namespace App\Livewire\Admin;

use App\Models\Package;
use Livewire\WithPagination;
use Livewire\Component;

class PackagesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $id, $description, $price, $class, $packagesId;

    public function render()
    {
        $packages = Package::where('description', 'like', '%' . $this->search . '%')
            ->select('id', 'description', 'price', 'class')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.admin.packages-index', compact('packages'));
    }

    public function edit($id)
    {
        $package = Package::where('id', $id)->select('id', 'description', 'price', 'class')->first();
        $this->id = $package->id;
        $this->description = $package->description;
        $this->price = $package->price;
        $this->class = $package->class;
    }

    public function update($id)
    {
        $this->validate([
            'description' => 'required',
            'price' => 'required',
            'class' => 'required',
        ]);

        try {

            Package::where('id', $id)->update([
                'description' => $this->description,
                'price' => $this->price,
                'class' => $this->class,
            ]);

            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha actualizado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al actualizar un nuevo usuario']);
        }
    }

    public function confirmDestroy($id)
    {
        $this->packagesId = $id;
        $this->dispatch('confirmDeleteAppointments', [
            'message' => '¿Estás seguro?',
            'confirmButtonText' => 'Sí, eliminarlo',
        ]);
    }


    public function destroy()
    {
        try {
            Package::where('id', $this->packagesId)->firstOrFail()->delete();
            $this->dispatch('success', ['message' => 'Se ha eliminado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al eliminar el evento']);
        }
    }
}
