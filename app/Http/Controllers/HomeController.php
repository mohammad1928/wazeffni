<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function report(Request $request){
        $report=new Report();
        $report->user_id=Auth::id();
        $report->description=$request->report;
        if(isset($request->image)){
            $report->image=$request->image->hashName();
            $request->image->store('/reports_pictures',['disk'=>'my_files']);
        }
        $report->save();
        return redirect(url()->previous());
    }
}
