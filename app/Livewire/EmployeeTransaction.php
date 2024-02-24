<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeTransaction extends Component
{
    use WithPagination;

    public ?User $user;
    public $length = 100;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortOrder = 'DESC';

    public function mount(User $user): void
    {
        $this->user = $user;
    }

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
        $data = $this->user->transactions()
            ->where(function ($query) {
                $query->where('created_at', 'like', '%' . $this->search . '%')
                    ->orWhere('type', 'like', '%' . $this->search . '%')
                    ->orWhere('reimbursement', 'like', '%' . $this->search . '%')
                    // ->orWhereHas('details', function ($query) {
                    //     return $query->orWhereRelation('product', 'name', 'like', '%' . $this->search . '%');
                    // })
                    // ->orWhereRelation('details', 'product.name', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('link', 'amount', 'like', '%' . $this->search . '%')
                    ->orWhere('bonus', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->length);

        return view('livewire.employee-transaction', compact('data'))
            ->layout('layouts.app');
    }
}
