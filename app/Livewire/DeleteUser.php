<?php

namespace App\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DeleteUser extends ModalComponent
{
    public ?User $user;

    public function mount(User $user){
        $this->user = $user;
    }

    public function render()
    {
        $user = $this->user;
        return view('livewire.delete-user', compact('user'));
    }

    public function confirmDelete()  {
        $this->user->delete();
        return redirect()->route('employee-list')->with(['success' => "User deleted"]);
    }
}
