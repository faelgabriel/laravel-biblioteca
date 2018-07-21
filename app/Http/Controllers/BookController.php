<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$books = Book::paginate(10);
	   	return view('book.index', compact('books'));
    }

    public function add()
    {
    	return view('book.add');
    }

    public function save(Request $request)
    {
    	$result = Book::create([
    		'title' => $request->input('title'), 
    		'description' => $request->input('description'), 
		]);

    	return redirect()->route('book.index');	
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if(!$book){
            return redirect()->route('book.index');
        }

        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $result = Book::find($id)->update([
            'title' => $request->input('title'), 
            'description' => $request->input('description'), 
        ]);
        
        return redirect()->route('book.index');
    }

    public function delete($id)
    {
        $book =  Book::find($id);

        if($book){
            $result = $book->delete();
        }

        return redirect()->route('book.index');
    }

    public function search(Request $request)
    {
        $name = $request->input('title');
        $search = TRUE;
        if($name){
            $books = Book::where('title', 'like', '%' . $name . '%')->get();
        }
        return view('book.index', compact('books', 'search'));
    }
}
