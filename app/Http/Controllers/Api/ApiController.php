<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Lending;

class ApiController extends Controller{

    public function authors(){
        $authors = Author::get();
        return response()->json($authors);
    }
    
    public function books(){
        $books = Book::get();
        return response()->json($books);
    }

    public function lendings(){
        $lendings = Lending::get();
        return response()->json($lendings);
    }
}