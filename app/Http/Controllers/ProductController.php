<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImages;
use DB;
use Validator;

class ProductController extends Controller
{

    private $path = 'images/product';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::get();
        $categories = Category::get();
        $selected_cat = [];

        return view('product.index', compact('products', 'categories', 'selected_cat'));
    }

    public function add()
    {
    	$categories = Category::where('active', 1)->get();
    	return view('product.add', compact('categories'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10|max:255',
            'description' => 'required',
        ]);

        if(!$validator->fails()){
            $images = $request->file('images');

            $product = Product::create([
                'name' => $request->input('name'), 
                'description' => $request->input('description')
            ]);

            if($product){
                foreach ($images as $key => $row) {
                    if(!empty($row)){
                        $fileName = time() . $key . '.' . $row->getClientOriginalExtension();
                        $row->move($this->path, $fileName);
                        $image = new ProductImages;
                        $image->product_id = $product->id;
                        $image->image = $fileName;
                        $image->save();
                    }
                }
                $product->categories()->sync($request->input('category'));
            }
        }
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if(!empty($product)){
            $categories = Category::get();
            $images = ProductImages::where('product_id', $product->id)->get();
            $selected_cat = array();

            foreach ($product->categories as $category) {
                $selected_cat[] = $category->pivot->category_id;
            }
            return view('product.edit', compact('product', 'categories', 'selected_cat', 'images'));
        }

        return redirect()->route('product.index');
    }

    public function update(Request $request, $id)
    {
        $images = $request->file('images');
        $category = $request->input('category');

        $product = Product::find($id);

        if(!empty($product)){
            if(!empty($images)){
                foreach ($images as $key => $row) {
                    if(!empty($row)){
                        $fileName = time() . $key . '.' . $row->getClientOriginalExtension();
                        $row->move($this->path, $fileName);

                        $image = new ProductImages;
                        $image->product_id = $product->id;
                        $image->image = $fileName;
                        $image->save();
                    }
                }
            }

            if(!empty($category)){
                $product->categories()->sync($category);
            }
            $product->update([
                'name' =>  $request->input('name'),
                'description' =>  $request->input('description')
            ]);
        }
        return redirect()->route('product.index');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if($product){
            $images = ProductImages::where('product_id', $product->id)->get();
            if(!empty($images)){
                foreach ($images as $row) {
                    if(file_exists($this->path . '/' . $row->image)){
                        unlink($this->path . '/' . $row->image);
                    }
                }
            }
            $product->categories()->detach();
            $product->images()->delete();
            $result = $product->delete();
        }

        return redirect()->route('product.index');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $selected_cat = $request->input('category');

        $search = TRUE;

        $query = DB::table('products')
                    ->select('products.id', 'products.name', 'products.description')
                    ->where('products.active', '=', 1)
                    ->join('products_categories', 'products.id', '=', 'products_categories.product_id')
                    ->join('categories', 'products_categories.category_id', '=', 'categories.id')
                    ->groupBy('products.id', 'products.name', 'products.description');

        if(!empty($name) && !empty($selected_cat)){
            $query->where('products.name', 'like', '%' . $name . '%');
            $query->whereIn('categories.id', $selected_cat);
        }else if(!empty($name)){
            $query->where('products.name', 'like', '%' . $name . '%');
        }else if(!empty($selected_cat)){
            $query->whereIn('categories.id', $selected_cat);
        }

        $categories = Category::where('active', 1)->get();
        $products = $query->get();

        if(empty($selected_cat)){
            $selected_cat = [];
        }

        return view('product.index', compact('products', 'categories', 'selected_cat', 'search'));
    }

}