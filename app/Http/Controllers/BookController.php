<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Author;
use App\User;
use DB;
use Validator;

class BookController extends Controller
{

    private $path = 'images';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $role = User::find($user->id)->role;
        $books = Book::get();
        $authors = Author::get();

        return view('book.index', compact('role', 'books', 'authors'));
    }

    public function add()
    {
        $authors = Author::get();
        return view('book.add', compact('authors'));
    }    

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'description' => 'required',
        ]);

        if (!empty($request->file('image')) && $request->file('image')->isValid()) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($this->path, $fileName);
        }

        if(!$validator->fails()){

            $book = Book::create([
                'title' => $request->input('title'), 
                'description' => $request->input('description'),
                'image' => $fileName
            ]);

            if($book){
                $authors = Author::find($request->input('autor'));
                $book->authors()->attach($authors);
            }
        }
        return redirect()->route('book.index');
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if(!empty($book)){
            $authors = Author::get();
            $selected_aut = array();

            foreach ($book->authors as $author) {
                $selected_aut[] = $author->pivot->author_id;
            }
            return view('book.edit', compact('book', 'authors', 'selected_aut'));
        }

        return redirect()->route('product.index');
    }

    public function update(Request $request, $id)
    {
        $author = $request->input('author');
        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();

        $book = Book::find($id);

        if(!empty($book)){

            if(!empty($author)){
                $book->authors()->sync($author);
            }
            $book->update([
                'title' =>  $request->input('title'),
                'description' =>  $request->input('description'),
                'image' => $fileName
            ]);
        }
        return redirect()->route('book.index');
    }

    public function delete($id)
    {
        $book = Book::find($id);

        if($book){

            $book->authors()->detach();
            $result = $book->delete();
        }

        return redirect()->route('book.index');
    }

    public function search(Request $request)
    {
        $title = $request->input('title');
        $search = TRUE;
        if($title){
            $books = Book::where('title', 'like', '%' . $title . '%')->get();
        }
        return view('book.index', compact('books', 'search'));
    }

}