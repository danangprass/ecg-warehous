<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $length = 100;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortOrder = 'DESC';

    public function setSortBy($sortByField)
    {
        if($this->sortBy == $sortByField){
            $this->sortOrder = ($this->sortOrder == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
           
        $this->sortBy = $sortByField;
        $this->sortOrder = 'DESC';
    }

    public function render(Request $request)
    {
        $data = User::with('roles')->where('name', 'like', '%' . $this->search . '%')
            ->orWhereRelation('roles', 'name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('bank_account', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->length);
        return view('user.index', compact('data',))
            ->layout('layouts.app');
    }
}
