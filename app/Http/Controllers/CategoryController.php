<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    private $path = 'images/category';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$categories = Category::paginate(10);
	   	return view('category.index', compact('categories'));
    }

    public function add()
    {
    	return view('category.add');
    }

    public function save(Request $request)
    {

		if (!empty($request->file('image')) && $request->file('image')->isValid()) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($this->path, $fileName);
        }

    	$result = Category::create([
    		'name' => $request->input('name'), 
    		'image' => $fileName
		]);

    	return redirect()->route('category.index');	
    }

    public function edit($id)
    {
        $category = Category::find($id);

        if(!$category){
            return redirect()->route('category.index');
        }

        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $fileName = NULL;

        if (!empty($request->file('image')) && $request->file('image')->isValid()) {
            if(!empty($request->input('deleteimage')) && file_exists($this->path . '/' . $request->input('deleteimage'))){
                unlink($this->path . '/' . $request->input('deleteimage'));
            }
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($this->path, $fileName);
        }

        if(!$fileName){
            $update = [
                'name' =>  $request->input('name'),
            ];
        }else{
            $update =[
                'name' =>  $request->input('name'),
                'image' => $fileName
            ];
        }

        $result = Category::find($id)->update($update);
        
        return redirect()->route('category.index');
    }

    public function delete($id)
    {
        $category =  Category::find($id);

        if($category){
            $category->products()->detach();
            $result = $category->delete();
        }

        return redirect()->route('category.index');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $search = TRUE;
        if($name){
            $categories = Category::where('name', 'like', '%' . $name . '%')->get();
        }
        return view('category.index', compact('categories', 'search'));
    }
}
