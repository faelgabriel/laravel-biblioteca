<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Lending;

class LendController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::get();

        return view('lend.index', compact('books'));
    }

    public function save(Request $request)
    {
        $lending = Lending::create([
            'user_id' => Auth::id(), 
            'date_start' => date('Y-m-d'),
            'date_end' => date('Y-m-d', strtotime("+7 days")),
            'date_finish' => null
        ]);

        if($lending){
            $lending->books()->sync($request->input('book'));
        }

        return redirect()->route('lending.index'); 
    }

    public function return($id)
    {
        $result = Lending::find($id)->update([
            'date_finish' => now(),
        ]);
        
        return redirect()->route('lending.index');
    }

}
