<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use Nerd;

class PagesController extends Controller
{

    public function __invoke($parent,$child)
    {
    	$gigs = $this->gigs(Nerd::getMenuId($parent),Nerd::getSubMenuId($child));

    	$title = Nerd::pageTitleFromSlug($parent);
    	
    	return view("front.page",compact('gigs','title'));
    }

    
}
