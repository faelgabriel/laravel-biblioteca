<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$authors = Author::paginate(10);
	   	return view('author.index', compact('authors'));
    }

    public function add()
    {
    	return view('author.add');
    }

    public function save(Request $request)
    {
    	$result = Author::create([
    		'name' => $request->input('name'), 
    		'surname' => $request->input('surname'), 
		]);

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
        $result = Author::find($id)->update([
            'name' => $request->input('name'), 
            'surname' => $request->input('surname'), 
        ]);
        
        return redirect()->route('author.index');
    }

    public function delete($id)
    {
        $author =  Author::find($id);

        if($author){
            $result = $author->delete();
        }

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
