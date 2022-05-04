<div>
    
        <div class="card">
            <h2 class="card-header clear-all">Notifications <small wire:click="clearAll" class="cl-all text-muted">Clear All</small></h2>
            <div class="card-body">
                <div class="row">
                    @if(count($myNotifications)>0)
                        @foreach($myNotifications as $notification)
                            @if($notification->notify_type == "present" && $notification->company_id==Auth::id())
                                <div class="col-md-12 mb-3 box">
                                    <img src="{{asset('profile_pictures/'.$notification->user->profile_picture)}}" width=75 height=75 class="rounded-circle p-1 border">
                                    <!--<i wire:click="clearNotification({{$notification->id}})" class="fas fa-trash delete text-muted" title="clear"></i>-->
                                       
                                        <span class="ml-3">
                                                <a href="/profile/{{$notification->user->id}}" class="text-primary">{{$notification->user->fname.' '.$notification->user->lname}}</a>
                                                Has Been Presented on Your <a href="/company/{{Auth::id()}}/#{{$notification->post->id}}" class="text-info">{{$notification->post->job_title}}</a> job.
                                        </span>
                                        <span class="float-right mr-5 mt-3">
                                                <button wire:click="accept({{$notification->user->id}},{{$notification->post->id}})" class="btn btn-outline-success">Accept</button>
                                                <button wire:click="reject({{$notification->user->id}},{{$notification->post->id}})" class="btn btn-outline-danger">Reject</button>
                                        </span>
                                    <p class="text-muted ml-3"><small>{{$notification->created_at->diffForHumans()}}</small></p>
                                    
                                </div>
                                <hr class="w-100  mb-5">
                            @elseif($notification->user_id==Auth::id() && $notification->notify_type=='reportReply')
                                <div class="col-md-12 mb-3 box">
                                    <img src="{{asset('profile_pictures/default_user.png')}}" width=75 height=75 class="rounded-circle p-1 border">
                                    <i wire:click="clearNotification({{$notification->id}})" class="fas fa-trash delete text-muted" title="clear"></i>
                                        <span class="ml-3">
                                                {{ $notification->description }}
                                        </span>
                                    <p class="text-muted ml-3"><small>{{$notification->created_at->diffForHumans()}}</small></p>
                                    
                                </div>
                                <hr class="w-100  mb-5">
                            @else
                                <div class="col-md-12 mb-3 box">
                                        <img src="{{asset('company_pictures/'.$notification->company->picture)}}" width=75 height=75 class="rounded-circle p-1 border">
                                        <i wire:click="clearNotification({{$notification->id}})" class="fas fa-trash delete text-muted" title="clear"></i>
                                            <span class="ml-3">
                                                    @if(Auth::user()->isAccepted($notification->post->id))
                                                    
                                                            Congratulation, <span>Your Present to <a href="/company/{{$notification->company_id}}#{{$notification->post_id}}">{{$notification->post->job_title}}</a> Job
                                                             in <a href="/company/{{$notification->company->id}}">{{$notification->company->name}}</a> Company Has Been Accepted.
                                                            </span>
                                                        
                                                    @else
                                                            <span>Your Present to <a href="/company/#{{$notification->company_id}}">{{$notification->post->job_title}}</a>
                                                             in <a href="/company/{{$notification->company->id}}">{{$notification->company->name}}</a> Company Has Been Rejected, We Hope For You All Good.
                                                            </span>
                                                            
                                                    @endif
                                            </span>
                            
                                        <p class="text-muted ml-3"><small>{{$notification->created_at->diffForHumans()}}</small></p>
                                </div>
                                <hr class="w-100  mb-5">
                            @endif
                            

                        @endforeach
                    
                    @else
                        <div class="row w-100">
                            <div class="col-md-12">
                                <p class="text-muted d-flex justify-content-center align-items-center empty"> No Notifications <i class="far fa-bell ml-1"></i> </p>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
</div>
   
