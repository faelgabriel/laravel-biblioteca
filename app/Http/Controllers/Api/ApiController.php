<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ApiController extends Controller{

    public function products(){
        $products = Product::with(['categories','images'])->where('active',1)->get();
        return response()->json($products);
    }

    public function categories(){
        $categories = Category::where('active',1)->get();
        return response()->json($categories);
    }
}