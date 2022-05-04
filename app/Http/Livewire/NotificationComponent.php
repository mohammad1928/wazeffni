<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationComponent extends Component
{
    protected $listeners=[
        'notificationsUpdated'=>'$refresh',
    ];

    public function render()
    {
        $myNotifications=Notification::where('user_id',"!=",Auth::id())->where('notify_type','present')->orWhere('user_id',Auth::id())->where('notify_type',"reply")->orWhere('user_id',Auth::id())->where('notify_type','reportReply')->orderBy('id','desc')->get();
        return view('livewire.notification-component',compact('myNotifications'));
    }
    public function clearNotification($nId){
        DB::table('notifications')->where('id',$nId)->delete();
        $this->emit('Notifications_Updated');
        $this->emitTo('notification-counter','newNotification');
    }
    public function clearAll(){
        DB::table('notifications')->where('user_id',Auth::id())->where('sender','company')->orWhere('company_id',Auth::id())->where('sender','user')->delete();
        $this->emit('Notifications_Updated');
        $this->emitTo('notification-counter','newNotification');
    }
    public function accept($user_id,$post_id){
        DB::update('update job_user set isAccepted=? where user_id=? and post_id=? ',[true,$user_id,$post_id]);
        DB::table('notifications')->where('user_id',$user_id)->where('post_id',$post_id)->delete();
        DB::table('notifications')->insert([
            'user_id'=>$user_id,
            'company_id'=>Auth::id(),
            'post_id'=>$post_id,
            'sender'=>'company',
            'notify_type'=>'reply',
            'created_at'=>Carbon::now()->toDateTimeString(),
            
        ]);
        $this->emit('Notifications_Updated');
        
    }
    public function reject($user_id,$post_id){
        DB::update('update job_user set isAccepted=? where user_id=? and post_id=? ',[false,$user_id,$post_id]);
        DB::table('notifications')->where('user_id',$user_id)->where('post_id',$post_id)->delete();
        DB::table('notifications')->insert([
            'user_id'=>$user_id,
            'company_id'=>Auth::id(),
            'post_id'=>$post_id,
            'sender'=>'company',
            'notify_type'=>'reply',
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $this->emit('Notifications_Updated');
    }
}
