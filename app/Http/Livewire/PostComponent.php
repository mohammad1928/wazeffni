<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostComponent extends Component
{
    protected $listeners=['postsUpdated'=>'$refresh'];

    public $search="",$city="all",$category="all";
    public $filter,$presents;
    public $comments=[],$postId,$comment,$reply,$allReplies,$replyText,$postToDelete;
    public function render()
    {
        if(isset(Auth::user()->myCompany->id)){
            $cid=Auth::user()->myCompany->id;
        }else{
            $cid="nothing";
        }
        if($this->filter=="saved"){
            $posts=Auth::user()->mySavedPosts;
        }
        else if($this->filter==$cid){
            $posts=Post::where('company_id',$this->filter)->get();
        }
        else if($this->presents=="presents"){
            $posts=Auth::user()->presents;
        }
        else
        {
            if(isset($this->search) && isset($this->city) && isset($this->category))
            {
                if($this->city!="all" && $this->category!="all")
                    $posts=Post::where('description','like','%'.$this->search.'%')->where('city',$this->city)->where('category',$this->category)->orderByDesc('id')->get();
                else if($this->city=="all" && $this->category=="all")
                    $posts=Post::where('description','like','%'.$this->search.'%')->orderByDesc('id')->get();
                else if($this->city!="all" && $this->category=="all")
                    $posts=Post::where('description','like','%'.$this->search.'%')->where('city',$this->city)->orderByDesc('id')->get();
                else
                    $posts=Post::where('description','like','%'.$this->search.'%')->where('category',$this->category)->orderByDesc('id')->get();
            }
            else{
                $posts=Post::orderByDesc('id')->get();
            }
        }
        return view('livewire.post-component',compact('posts'));

    }
    public function setPostToDelete($postDelete){
        $this->postToDelete=$postDelete;
    }
    public function deletePost()
    {
        dd("Hi");
    }
    public function save($postId)
    {
        if(!Auth::check())
            return $this->redirect('/login');
        if(Auth::user()->isSaved($postId)){
            DB::table('post_user')->where('user_id',Auth::id())->where('post_id',$postId)->delete();
        }else{
            DB::table('post_user')->insert(
                [
                    'user_id' => Auth::id(),
                    'post_id' => $postId
                ]
            );
        }
        $this->emit('postUpdated');
    }

    public function presentJob($postId){
        if(!Auth::check())
            return $this->redirect('/login');
        if(Auth::user()->isPresented($postId)){
            DB::table('job_user')->where('user_id',Auth::id())->where('post_id',$postId)->delete();
            DB::table('notifications')->where('user_id',Auth::id())->where('post_id',$postId)->delete();
        }else{
            DB::table('job_user')->insert(
                [
                    'user_id' => Auth::id(),
                    'post_id' => $postId
                ]
            );
            DB::table('notifications')->insert([
                'user_id'=>Auth::id(),
                'company_id'=>Post::find($postId)->company->id,
                'post_id'=>$postId,
                'sender'=>'user',
                'notify_type'=>'present',
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }

        $this->emit('postUpdated');
        $this->emitTo('notification-counter','newNotification');
    }

    public function like($pid){
        if(!Auth::check())
            return $this->redirect('/login');
        if(Auth::user()->isLiked($pid)){
            DB::table('post_like')->where('user_id',Auth::id())->where('post_id',$pid)->delete();
        }else{
            DB::table('post_like')->insert(
                [
                    'user_id' => Auth::id(),
                    'post_id' => $pid
                ]
            );
        }
        $this->emit('postUpdated');
    }
    public function assignPost($post_id){
        $this->comments=Comment::where('post_id',$post_id)->get();
        $this->postId=$post_id;
    }
    public function addComment(){
        if(!Auth::check())
            return $this->redirect('/login');
        Comment::create([
            'user_id'=>Auth::id(),
            'post_id'=>$this->postId,
            'comment'=>$this->comment,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $this->comment="";
        $this->resetComments();
        $this->emit('postUpdated');
    }
    public function assignReply($replyId){
        $this->allReplies=Comment::find($replyId)->replies;
        if(!empty($this->reply)){
            unset($this->reply);
        }else{
            $this->reply=$replyId;
        }
    }
    public function addReply($commentId){
        if(!Auth::check())
            return $this->redirect('/login');
        Reply::create([
            'user_id'=>Auth::id(),
            'comment_id'=>$commentId,
            'reply'=>$this->replyText,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $this->replyText="";
        $this->resetReplies();
        $this->emit('postUpdated');
    }
    public function deleteComment($commentId){
        Comment::find($commentId)->delete();
        $this->resetComments();
        $this->emit('postUpdated');
    }
    public function resetComments(){
        $this->comments=Comment::where('post_id',$this->postId)->get();
    }
    public function resetReplies(){
        $this->allReplies=Comment::find($this->reply)->replies;
    }
    public function replyComment($id)
    {
        if(!Auth::check())
            return $this->redirect('/login');
    }

}
