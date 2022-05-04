<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ManageUsers extends Component
{
    public $userId,$search;
    public $oldEmail,$oldPassword;
    public $email,$password;
    public function render()
    {
        if(isset($this->search))
        {
            $users=User::where('fname','like','%'.$this->search.'%')->get();
        }
        else
        {
            $users=User::all();
        }
        

        return view('livewire.admin.manage-users',compact('users'));
    }
    public function assignUser($userId)
    {
        $user=User::find($userId);
        $this->email=$user->email;
        $this->userId=$userId;
    }
    public function deleteUser(){
        User::find($this->userId)->delete();
        $this->dispatchBrowserEvent('userDeleted');
    }
    public function editUser(){
        $this->validate([
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>'min:8',
        ]);
        $user=User::find($this->userId);
        $user->email=$this->email;
        $user->password=Hash::make($this->password);
        $user->save();
    }
}
