<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
	private $user;

    public function __invoke(Request $request)
    {
    	$this->user = $request->user();

    	$earning = $this->user->sellerTransaction
    	->where('ledger','cr')
    	->whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()])
    	->sum('amount');
    	
    	return view('seller.dashboard',[
    		'user' => $this->user,
    		'earning' => $earning,
    	]);
    }
}
