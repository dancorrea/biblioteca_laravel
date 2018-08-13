<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lending;
use App\Models\Book;
use App\User;
use DB;
use Validator;

class LendingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if($user->role == 1){
            $lendings = Lending::get();           
        } else{
            $lendings = Lending::where('user_id', $user->id)->get();   
        }
        
        $books = Book::get();

        return view('lending.index', compact('lendings', 'user', 'books'));
    }

    public function add()
    {
        $user = Auth::user();
        $books = Book::get();
        $date_start = date('Y/m/d');
        $date_end = date('Y/m/d', strtotime($date_start. ' + 7 days'));

        return view('lending.add', compact('user', 'books', 'date_start', 'date_end'));
    }

    public function save(Request $request)
    {
        $date_start = date('Y-m-d');
        $date_end = date('Y-m-d', strtotime($date_start. ' + 7 days'));

        $lending = Lending::create([
            'user_id' => Auth::user()->id,
            'date_start' => $date_start,
            'date_end' => $date_end
        ]);

        if($lending){
            $books = Book::find($request->input('book'));
            $lending->books()->attach($books);
        }
        
        return redirect()->route('lending.index');
    }

    public function edit($id)
    {
        $lending = Lending::find($id);

        if(!empty($lending)){
            $books = Book::get();
            $selected_book = array();

            foreach ($lending->books as $book) {
                $selected_book[] = $book->pivot->book_id;
            }

            return view('lending.edit', compact('lending', 'books', 'selected_book'));
        }

        return redirect()->route('lending.index');
    }

    public function update(Request $request, $id)
    {
        $book = $request->input('book');
        $date_end = $request->input('date_end');

        $lending = Lending::find($id);

        if(!empty($lending)){
            
            if(!empty($book)){
                $lending->books()->sync($book);
            }
            $lending->update([
                'date_end' =>  $request->input('date_end')
            ]);
        }
        return redirect()->route('lending.index');
    }

    public function delete($id)
    {
        $lending = Lending::find($id);

        if($lending){
            $lending->update([
                'date_finish' =>  date('Y-m-d')
            ]);
        }

        return redirect()->route('lending.index');
    }

}