<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Lending;

class ApiController extends Controller{

    public function books(){
        $books = Books::with(['authors'])->where('active',1)->get();
        return response()->json($books);
    }

    public function authors(){
        $authors = Author::where('active',1)->get();
        return response()->json($authors);
    }
}