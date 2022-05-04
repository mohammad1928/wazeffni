<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class NotificationCounter extends Component
{
    protected $listeners=[
        'newNotification'=>'$refresh',
    ];
    public $notification_count;
    public function render()
    {
        $this->notification_count=count(Notification::where('user_id',Auth::id())->where('sender','company')->where('isSeen',false)->orWhere('company_id',Auth::id())->where('sender','user')->where('isSeen',false)->get());
        return view('livewire.notification-counter');
    }
    public function mountData(){
        $this->notification_count=count(Notification::where('user_id',Auth::id())->where('sender','company')->orWhere('company_id',Auth::id())->where('sender','user')->where('isSeen',false)->get());
    }
    public function seeAll(){
        DB::update('UPDATE notifications SET isSeen=? WHERE company_id=? AND sender=? OR user_id=? AND sender=?',[1,Auth::id(),'user',Auth::id(),'company']);
    }
}
