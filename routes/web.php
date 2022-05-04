<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home-page',function(){
    return view('home-page');
});

Route::get('/',function(){
    return view('home');
});

Route::get('/profile/{id}',function($id){
    return view('profile',compact("id"));
});

Route::get('/company/{id}',function($id){

    return view('company',compact("id"));
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/add-job',function(){
        return view('add-job');
    });

    Route::get('/saved-posts',function(){
        $filter="saved";
        return view('saved-posts',compact('filter'));
    });
    Route::get('/my-presents',function(){
        $presents="presents";
        return view('my-presents',compact('presents'));
    });
    Route::get('/notifications',function(){
        return view('notifications');
    });

    Route::post('report',[App\Http\Controllers\HomeController::class,'report']);
});


//Admin Routes
Route::group(['middleware'=>'admin'],function(){

    Route::get('/dashboard',function(){
        return view('admin.manage-users')->with(['word'=>'users']);
    });

    Route::get('/dashboard/companies',function(){
        return view('admin.manage-companies')->with(['word'=>'companies']);
    });

    Route::get('/dashboard/jobs',function(){
        return view('admin.manage-jobs')->with(['word'=>'jobs']);
    });

    Route::get('/dashboard/presents',function(){
        return view('admin.manage-presents')->with(['word'=>'presents']);
    });

    Route::get('/dashboard/reports',function(){
        return view('admin.manage-reports')->with(['word'=>'reports']);
    });
});


//  Google Login
Route::get('/auth/google', function () {
    return Socialite::driver('google')->stateless()->redirect();
});

Route::get('/auth/google/callback', function () {


    $user=Socialite::driver('google')->stateless()->user();
    $findUser=User::where('google_id',$user->id)->first();

    if($findUser){
        Auth::login($findUser );
    }else{
        $newUser=User::create([
            'fname'=>$user->name,
            'lname'=>$user->name,
            'gender'=>'male',
            'birthdate'=>'2001/1/1',
            'email'=>$user->email,
            'google_id'=>$user->id,
            'password'=>encrypt('19372915463'),
        ]);
        Auth::login($newUser);
    }
    return redirect('/');


});

//  Github Login
Route::get('/auth/github', function () {
    return Socialite::driver('github')->stateless()->redirect();
});

Route::get('/auth/github/callback', function () {


    $user=Socialite::driver('github')->stateless()->user();
    $findUser=User::where('email',$user->email)->first();

    if($findUser){
        Auth::login($findUser);
    }else{
        $newUser=User::create([
            'fname'=>'mm',
            'lname'=>'mm',
            'gender'=>'male',
            'birthdate'=>'2001/1/1',
            'email'=>$user->email,
            'google_id'=>$user->id,
            'password'=>encrypt('19372915463'),
        ]);
        Auth::login($newUser);

    }
    return redirect('/');


});

//  Facebook Login
Route::get('/auth/facebook', function () {
    return Socialite::driver('facebook')->stateless()->redirect();
});

Route::get('/auth/facebook/callback', function () {


    $user=Socialite::driver('facebook')->stateless()->user();
    $findUser=User::where('google_id',$user->id)->first();

    if($findUser){
        Auth::login($findUser);
    }else{
        $newUser=User::create([
            'fname'=>$user->name,
            'lname'=>$user->name,
            'gender'=>'male',
            'birthdate'=>'2001/1/1',
            'email'=>$user->email,
            'google_id'=>$user->id,
            'password'=>encrypt('19372915463'),
        ]);
        Auth::login($newUser);
    }
    return redirect('/');


});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
