<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolePermissionTable extends Component
{


    use WithPagination;

    public $length = 100;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortOrder = 'DESC';

    public function setSortBy($sortByField)
    {
        if ($this->sortBy == $sortByField) {
            $this->sortOrder = ($this->sortOrder == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortOrder = 'DESC';
    }

    public function render()
    {
        $data = Role::where('name', 'like', '%' . $this->search . '%')
            ->orWhereRelation('users', 'name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate();

        return view('livewire.role-permission-table', compact('data'))->layout('layouts.app');
    }
}
