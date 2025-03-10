<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public $user;
    public function mount($userId){
        // dd($userId);
        $this->user = $this->getUser($userId);
    }
    public function render()
    {
        return view('livewire.chat');
    }

    /**
     * Function: getUser
     * @param mixed $userId
     * @return \Illuminate\Database\Eloquent\Collection<int, User>
     */
    public function getUser($userId){
        return User::find($userId);
    }
}
