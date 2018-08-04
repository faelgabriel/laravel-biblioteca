<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Book;
use App\Models\Lending;

class LendingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$lendings = Lending::paginate(10);
	   	return view('lending.index', compact('lendings'));
    }


    public function edit($id)
    {
        $lending = Lending::find($id);
        $books = Book::get();

        if(!$lending){
            return redirect()->route('lending.index');
        }

        $users = User::get();
        $selected_books = array();

        foreach ($lending->books as $book) {
            $selected_books[] = $book->pivot->book_id;
        }

        return view('lending.edit', compact('lending', 'users', 'selected_books', 'books'));
    }

    public function update(Request $request, $id)
    {
        $lending = Lending::find($id);
        $result = $lending->update([
            'user_id' => $request->input('user'),
            'date_start' => implode("-",array_reverse(explode("/", $request->input('date_start')))),
            'date_end' => implode("-",array_reverse(explode("/", $request->input('date_end')))),
            'date_finish' => implode("-",array_reverse(explode("/", $request->input('date_finish')))),
        ]);
        $lending->books()->sync($request->input('book'));
        
        return redirect()->route('lending.index');
    }

    public function delete($id)
    {
        $lending =  Lending::find($id);

        if($lending){
            $lending->books()->detach();
            $result = $lending->delete();
        }

        return redirect()->route('lending.index');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $search = TRUE;
        if($name){
            $lendings = Lending::where('name', 'like', '%' . $name . '%')->get();
        }
        return view('lending.index', compact('lendings', 'search'));
    }
}
