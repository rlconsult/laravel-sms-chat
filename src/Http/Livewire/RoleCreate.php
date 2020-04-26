<?php

namespace Filament\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Traits\Livewire\HasForm;
use Filament\Models\Role;

class RoleCreate extends Component
{    
    use AuthorizesRequests, HasForm;

    public function mount()
    {        
        $this->authorize('create', Role::class);

        $this->setFieldset();
        $this->setFormProperties();
    }

    public function success()
    {
        $input = collect($this->form_data);

        $role = Role::create($input->all());     
        
        if (auth()->user()->can('edit permissions')) {
            $role->syncPermissions($input->get('permissions'));
        }

        session()->flash('notification', [
            'type' => 'success',
            'message' => __('filament::notifications.created', ['item' => $role->name]),
        ]);

        return redirect()->route('filament.admin.roles.index');
    }

    public function render()
    {        
        return view('filament::livewire.roles.create-edit', [
            'title' => __('filament::roles.create'),
            'fields' => $this->fields(),
        ]);
    }
}
