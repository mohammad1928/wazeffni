<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function userSaved(){
        return $this->belongsToMany('App\Models\User','post_user');
    }
    public function presents(){
        return $this->belongsToMany('App\Models\User','job_user');
    }
    public function likers(){
        return $this->belongsToMany('App\Models\User','post_like');
    }
    public function notification(){
        return $this->belongsTo('App\Models\Notification');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
