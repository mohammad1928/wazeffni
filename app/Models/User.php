<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'birthdate',
        'email',
        'password',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function myCompany(){
        return $this->hasOne('App\Models\Company','id');
    }
    public function myLanguages(){
        return $this->hasMany('App\Models\Language');
    }   
    public function mySkills(){
        return $this->hasMany('App\Models\Skill');
    }
    public function myEducation(){
        return $this->hasMany('App\Models\Education');
    }
    public function myExperience(){
        return $this->hasMany('App\Models\Experience');
    }
    public function mySavedPosts(){
        return $this->belongsToMany('App\Models\Post','post_user');
    }
    public function role(){
        return $this->hasOne('App\Models\Role','id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }


    
    public function isSaved($pid){
        $post=DB::select('select * from post_user where user_id=? and post_id=?',[Auth::id(),$pid]);
        if(!empty($post)){
            return true;
        }else{
            return false;
        }
    }
    public function presents(){
        return $this->belongsToMany('App\Models\Post','job_user');
    }
    public function isPresented($pid){
        $post=DB::select('select * from job_user where user_id=? and post_id=?',[Auth::id(),$pid]);
        if(!empty($post)){
            return true;
        }else{
            return false;
        }
    }
    public function myLikes(){
        return $this->belongsToMany('App\Models\Post','post_like');
    }
    public function isLiked($pid){
        $post=DB::select('select * from post_like where user_id=? and post_id=?',[Auth::id(),$pid]);
        if(!empty($post)){
            return true;
        }else{
            return false;
        }
    }
    public function myNotifications(){
        return $this->hasMany('App\Models\Notification');
    }
    public function getPresent($postId){
        return DB::table('job_user')->where('user_id',Auth::id())->where('post_id',$postId)->get();
    }
    public function isAccepted($post_id)
    {
        $present=DB::select('select isAccepted from job_user where user_id=? and post_id=?',[Auth::id(),$post_id]); 
        if(isset($present[0]->isAccepted))
        {
            if($present[0]->isAccepted==true)
            {
                return true;
            }
            else
            {
                return false;
            }
        
        }
    }
}
