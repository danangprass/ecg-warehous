<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if ($this->sortBy == $sortByField) {
            $this->sortOrder = ($this->sortOrder == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortOrder = 'DESC';
    }

    public function render(Request $request)
    {
        //    $res = DB::table('view_transactions')->where('owner_id', 1)->get();
        // $data = User::with('roles')
        //     ->addSelect([
        //         "*",
        //         DB::raw("(SELECT SUM(view_transactions.fee) FROM view_transactions WHERE view_transactions.owner_id = users.id ) as fee"),
        //         DB::raw("(SELECT SUM(view_transactions.reimburse) FROM view_transactions WHERE view_transactions.owner_id = users.id ) as reimburse")
        //     ])->where('name', 'like', '%' . $this->search . '%')
        //     ->orWhereRelation('roles', 'name', 'like', '%' . $this->search . '%')
        //     ->orWhere('email', 'like', '%' . $this->search . '%')
        //     ->orWhere('bank_account', 'like', '%' . $this->search . '%')
        //     ->orderBy($this->sortBy, $this->sortOrder)
        //     ->paginate($this->length);

        // dd($res->toArray());


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
