<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Report;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ManageReports extends Component
{
    public $search,$reportId,$replyText,$userId;
    public function render()
    {
        if(isset($this->search))
        {
            $reports=Report::where('description','like','%'.$this->search.'%')->orderBy('id','desc')->paginate(8);
        }
        else
        {
            $reports=Report::orderBy('id','desc')->paginate(7);
        }
        return view('livewire.admin.manage-reports',compact('reports'));
    }

    public function assignReport($reportId,$userId)
    {
        $this->reportId=$reportId;
        $this->userId=$userId;
    }

    public function deleteReport()
    {
        Report::find($this->reportId)->delete();
        $this->dispatchBrowserEvent('reportDeleted');
    }
    public function reply(){
        $notification=new Notification();
        $notification->user_id=$this->userId;
        $notification->sender="admin";
        $notification->notify_type="reportReply";
        $notification->description=$this->replyText;
        $notification->save();
    }
   
}
