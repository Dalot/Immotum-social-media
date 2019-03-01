<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class PagesController extends Controller
{
    
    
    public function home()
    {
        return view('home', ["foo"=> "bar"]);
    }
    
     public function homepage()
    {
        return view('homepage');
    }
    

    public function about()
    {
        return view('about');
    }
    
    public function contact()
    {
        return view('contact');
    }
}
