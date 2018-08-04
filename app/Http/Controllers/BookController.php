<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use DB;
use Validator;

class BookController extends Controller
{

    private $path = 'images/book';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$books = Book::paginate(10);
        $authors = Author::get();
        $selected_authors = [];

	   	return view('book.index', compact('books', 'authors', 'selected_authors'));
    }

    public function add()
    {
        $authors = Author::get();
        return view('book.add', compact('authors'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:255',
            'description' => 'required',
        ]);

        if(!$validator->fails()){
            if (!empty($request->file('image')) && $request->file('image')->isValid()) {
                $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($this->path, $fileName);
            }
            $book = Book::create([
                'title' => $request->input('title'), 
                'description' => $request->input('description'),
                'image' => $fileName
            ]);

            if($book){
                $book->authors()->sync($request->input('author'));
            }
        }

    	return redirect()->route('book.index');	
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if(!$book){
            return redirect()->route('book.index');
        }

        $authors = Author::get();
        $selected_authors = array();

        foreach ($book->authors as $author) {
            $selected_authors[] = $author->pivot->author_id;
        }

        return view('book.edit', compact('book', 'authors', 'selected_authors'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('book.index');
        }

        $fileName = NULL;

        if (!empty($request->file('image')) && $request->file('image')->isValid()) {
            if(!empty($request->input('deleteimage')) && file_exists($this->path . '/' . $request->input('deleteimage'))){
                unlink($this->path . '/' . $request->input('deleteimage'));
            }
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($this->path, $fileName);
        }

        $author = $request->input('author');
        if(!empty($author)) {
            $book->authors()->sync($author);
        }

        if ($fileName !== null) {
            $update = [
                'title' =>  $request->input('title'),
                'description' => $request->input('description'), 
                'image' => $fileName
            ];
        } else {
            $update = [
                'title' =>  $request->input('title'),
                'description' => $request->input('description')
            ];
        }

        $result = $book->update($update);

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
        $title = $request->input('title');
        $search = TRUE;
        if($title){
            $books = Book::where('title', 'like', '%' . $title . '%')->get();
        }
        return view('book.index', compact('books', 'search'));
    }
}
