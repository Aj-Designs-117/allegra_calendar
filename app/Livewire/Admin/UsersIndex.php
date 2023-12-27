<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $id, $name, $email, $password,  $selectedRoles = [];

    public function render()
    {
        $users = User::whereNotIn('id', array_merge([1, 2]))
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(15);
        $roles = Role::select('id', 'name')->get();
        return view('livewire.admin.users-index', compact('users', 'roles'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->select('id', 'name', 'email')->first();
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles()->pluck('name')->toArray();
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string'
        ]);

        try {

            User::where('id', $id)->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha actualizado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al actualizar un nuevo usuario']);
            $this->resetFields();
        }
    }

    public function assignArole($id)
    {
        try {
            $user = User::find($id);
            $user->syncRoles($this->selectedRoles);

            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha asignado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al asignar los roles']);
        }
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            $this->dispatch('success', ['message' => 'Se ha eliminado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al eliminar al usuario']);
        }
    }
}
