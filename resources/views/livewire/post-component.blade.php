
<div>

@if(($filter == "" || $presents == "presents") && ($filter == "present" || $presents == ""))
<div class="row mb-5 filter">
      <div class="col-md-7 mb-1">
          <input wire:model="search" type="search" list="suggestions" class="form-control" placeholder="Search">
          @if($search!="")
          <datalist id="suggestions">
            @foreach($posts as $post)
                <option value="{{$post->description}}">{{$post->description}}</option>
            @endforeach
          </datalist>
          @endif
      </div>
      <div class="col-md-3 mb-1">
          <select wire:model="city" class="form-control">
              <option value="all">All Cities</option>
              <option value="Hama">Hama</option>
              <option value="Homs">Homs</option>
              <option value="Idleb">Idleb</option>
              <option value="Damascus">Damascus</option>
              <option value="Aleppo">Aleppo</option>
          </select>
      </div>
      <div class="col-md-2 mb-1">
          <select wire:model="category" class="form-control">
              <option value="all">All Jobs</option>
              <option value="IT">IT</option>
              <option value="calculating">Calculating</option>
              <option value="construction">Construction</option>
              <option value="education">Teacher</option>
          </select>
      </div>
  </div>
  @endif

@if (count($posts)>0)
@foreach($posts as $post)
<div id="{{$post->id}}" class="card posts-card">
            <div class="card-title row pt-3 pl-3">
                <div class="col-md-1">
                     <img src="{{asset('company_pictures/'.$post->company->picture)}}" class="rounded-circle ml-2 home-profile-picture">
                </div>
                <div class="col-md-11">
                    <span class="" style="font-size:18px"><a href="/company/{{$post->company->id}}">{{$post->company->name}}</a></span>
                    <br>
                    <small class="text-muted"><i class="fas fa-business-time"></i> {{$post->created_at->diffForHumans()}}</small>
                </div>
                <div class="btn-group dropright post-menu">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button wire:click="save({{$post->id}})"  class="dropdown-item btn">
                         <i class="fas fa-bookmark text-primary"></i>
                         @if(Auth::check())
                                @if(Auth::user()->isSaved($post->id))
                                    إلغاء الحفظ
                                @else
                                    جفظ
                                @endif
                        @else
                             حفظ
                        @endif
                        </button>
                        @if($post->company_id==Auth::id())
                            <button wire:click="setPostToDelete({{$post->id}})" class="dropdown-item" data-toggle="modal" data-target="#deletePostModal"><i class="fas fa-trash-alt text-primary"></i> Delete Post</button>
                        @endif
                        <a href="#"  class="dropdown-item"><i class="fas fa-user-shield text-primary"></i> إبلاغ</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body">
                    <h2>{{$post->job_title}}</h2>
                    <p>{{$post->description}}</p>
                    <p><i class="fas fa-map-marker-alt"></i> <span class="text-bold">City</span> : {{$post->city}}</p>
                    <p><i class="fas fa-toolbox"></i> Requirements Skills :</p>
                    <div class="ml-3">
                        <pre style="font-family: Arial, Helvetica, sans-serif">{{$post->requirements_skills}}</pre>
                    </div>
                    <p><i class="fas fa-money-check-alt"></i></i> Salary : {{$post->minSalary.'-'.$post->maxSalary}}</p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button wire:click="like({{$post->id}})" class="btn @if(Auth::check()) @if(Auth::user()->isLiked($post->id)) btn-primary @else btn-outline-primary  @endif @endif" title="أعجبني"><i class="fas fa-thumbs-up mr-1"></i>{{count($post->likers)}}</button>
                <button wire:click="assignPost({{$post->id}})" class="btn btn-primary" title="التعليقات" data-toggle="modal" data-target="#showCommentsModal"><i class="far fa-comment mt-1 mr-1"></i>@if(count($post->comments)>0) {{count($post->comments)}} @endif</button>
                @if(Auth::check())
                    @if(Auth::user()->isPresented($post->id))
                        <button wire:click="presentJob({{$post->id}})" class="btn btn-primary" title="Unpresent" @if(Auth::id()==$post->company->id) disabled @endif><i class="far fa-check pl-2 pr-2"></i></button>
                    @else
                        <button wire:click="presentJob({{$post->id}})" class="btn btn-outline-primary" title="Present" @if(Auth::id()==$post->company->id) disabled @endif><i class="far fa-check pl-2 pr-2"></i></button>
                    @endif
                @else
                    <button wire:click="presentJob({{$post->id}})" class="btn btn-outline-primary" title="التقديم على العمل"><i class="far fa-check pl-2 pr-2"></i></button>
                @endif
            </div>
</div>
@endforeach
@else

<div class="d-flex justify-content-center align-items-center" style="height: 600px">
    <p class="text-muted">No Posts Available</p>
</div>

@endif


<div wire:ignore.self  class="modal fade mt-4" id="showCommentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div  class="modal-dialog modal-dialog-scrollable" role="document" >
                        <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">التعليقات @if(count($comments)>0) ({{ count($comments) }}) @endif</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body" dir="rtl">
                            @foreach($comments as $comment)
                                <div class="p-2 mt-1">
                                   <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{asset('profile_pictures/'.$comment->user->profile_picture)}}" class="rounded-circle" width=50 height=50>
                                        </div>
                                        <div class="col-md-10 rounded p-2" style="background:#f6f6f6">
                                            <h5 class="text-primary mt-2">
                                                <a href="/profile/{{$comment->user->id}}">{{$comment->user->fname.' '.$comment->user->lname}}</a>
                                                <div class="btn-group dropright post-menu">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if($comment->user_id==Auth::id())
                                                            <button wire:click="editComment({{$comment->id}})" class="dropdown-item"><i class="fas fa-edit text-primary"></i> تعديل التعليق</button>
                                                            <button wire:click="deleteComment({{$comment->id}})" class="dropdown-item"><i class="fas fa-trash-alt text-danger"></i> حذف التعليق</button>
                                                        @endif
                                                        <button wire:click="replyComment({{$comment->id}})" class="dropdown-item"><i class="fas fa-user-shield text-muted"></i> الإبلاغ عن التعليق</button>
                                                    </div>
                                                </div>
                                            </h5>
                                            <div class="ml-2 mt-1" style="overflow-wrap: break-word">{{$comment->comment}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 ml-4 mb-3">
                                    <small class="text-muted mt-1 ml-5">{{$comment->created_at->diffForHumans()}}</small>
                                    <a class="">إعجاب</a>
                                    <a wire:click="assignReply({{$comment->id}})" class="" style="cursor:pointer">رد @if(count($comment->replies)>0) ({{count($comment->replies)}})@endif</a>
                                </div>
                                    @if($reply===$comment->id)
                                        <div class="ml-5 mt-1">
                                           @if(isset($allReplies))
                                                @foreach ($allReplies as $reply )
                                                <div class="row ml-2 mt-1" style="position: relative">
                                                    <span class="reply">.</span>
                                                    <span class="reply2">.</span>
                                                    <div class="col-md-2">
                                                        <img src="{{asset('profile_pictures/'.$reply->user->profile_picture)}}" class="rounded-circle" width=35 height=35>
                                                    </div>
                                                    <div class="col-md-10 rounded p-2" style="background:#f6f6f6">
                                                        <h6 class="ml-2 text-primary mt-2"><a href="/profile/{{$reply->user->id}}">{{$reply->user->fname.' '.$reply->user->lname}}</a></h6>
                                                        <p class="ml-2 mt-1">{{$reply->reply}}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                           @endif
                                           <form wire:submit.prevent="addReply({{$comment->id}})" class="w-100">
                                           <div class="input-group mt-2 ml-3 mr-3">
                                                    <input wire:model="replyText" type="text" class="form-control" placeholder="اكتب الرد">
                                                    <span class="input-group-prepend"><button type="submit" class="btn btn-primary" title="Send"><i class="fas fa-paper-plane"></i></button></span>
                                            </div>
                                        </form>
                                        </div>
                                    @endif
                                <hr>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <form wire:submit.prevent="addComment" class="w-100">
                                <div class="form-group">
                                    <div class="input-group" dir="rtl">
                                        <input wire:model="comment" type="text" class="form-control" placeholder="اكتب تعليق">
                                        <span class="input-group-prepend"><button type="submit" class="btn btn-primary" title="Send"><i class="fas fa-paper-plane"></i></button></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

</div>

{{-- Delete Post Modal --}}

<div wire:ignore.self class="modal fade mt-5" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                    <p>Do you want to delete this post ?</p>
            </div>
            <div class="modal-footer">
                <button wire:click="deletePost" type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                <button wire:click="setPostToDelete(1)" class="btn btn-primary pl-5 pr-5">Update</button>
            </div>
            </div>
    </div>
</div>







