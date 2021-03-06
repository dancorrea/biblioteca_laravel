<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('home');
    }
}