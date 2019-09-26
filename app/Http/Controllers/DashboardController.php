<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gig;

class DashboardController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
    	 $gigs = Gig::with('user','user.userDetail','menu','subMenu')->whereStatus(true)
                ->whereIsStatus(1)
                ->take(20)
                ->orderBy('id',"desc")
                ->get();

        $weekly = Gig::with('user','user.userDetail')->whereStatus(true)
                ->whereIsStatus(1)
                ->take(20)
                ->orderBy('id',"desc")
                ->get();
        return view('home',compact('gigs','weekly'));
    }
}
