<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;
use App\User;
use DB;
use Validator;

class AuthorController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $role = User::find($user->id)->role;
		$authors = Author::paginate(10);
	   	return view('author.index', compact('role', 'authors'));
    }

    public function add()
    {
    	return view('author.add');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:25',
            'surname' => 'required|min:3|max:25',
        ]);

        if(!$validator->fails()){

            $author = Author::create([
                'name' => $request->input('name'), 
                'surname' => $request->input('surname')
            ]);
            
        }
        return redirect()->route('author.index');
    }

    public function edit($id)
    {
        $author = Author::find($id);

        if(!$author){
            return redirect()->route('author.index');
        }

        return view('author.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
    	$update =[
                'name' =>  $request->input('name'),
                'surname' => $request->input('surname')
            ];

        $result = Author::find($id)->update($update);
        
        return redirect()->route('author.index');
    }

    public function delete($id)
    {
        $author =  Author::find($id);
        $result = $author->delete();

        return redirect()->route('author.index');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $search = TRUE;
        if($name){
            $authors = Author::where('name', 'like', '%' . $name . '%')->get();
        }
        return view('author.index', compact('authors', 'search'));
    }

}