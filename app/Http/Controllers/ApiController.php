<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class ApiController extends Controller
{
    public function getUsers($id=null){
        return $id ? User::find($id): User::all();
    }
    public function searchUsers($name){
        return User::where('fname','like','%'.$name.'%')->orWhere('lname','like','%'.$name.'%')->get();
    }
    public function addRole(Request $req){
        $role=new Role();
        $role->id=$req->id;
        $role->role=$req->role;
        $result=$role->save();
        if($result){
            return redirect('/testApi')->with(["result"=>"Role Added Successfully"]);
        }else{
            return redirect('/testApi')->with(["result"=>"Role Added Successfully"]);
        }
    }
    public function updateRole(Request $req){
        $role=Role::find($req->id);
        $role->role=$req->role;
        $result=$role->save();
        return $result;
    }
}
