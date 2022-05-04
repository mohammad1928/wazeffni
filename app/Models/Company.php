<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function myNotifications(){
        return $this->hasMany('App\Models\Notification','company_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','id');
    }
}
