<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$users = User::paginate(10);
	   	return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        if(!$user){
            return redirect()->route('user.index');
        }

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $role = ($request->input('role') != 0 && $request->input('role') != 255) ? 0 : $request->input('role');

        $result = User::find($id)->update([
            'role' => $role,
        ]);

        return redirect()->route('user.index');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $search = TRUE;
        if($name){
            $users = User::where('name', 'like', '%' . $name . '%')->get();
        }
        return view('user.index', compact('users', 'search'));
    }
}
