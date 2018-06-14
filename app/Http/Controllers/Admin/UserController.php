<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Rol;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function index()
    {
        $users=User::with('rol')->orderBy('name','asc')->paginate(10);
        
        return view('admin.user.index')->with(compact('users'));
    }

    public function create()
    {
        $rols = Rol::select('id','name')->orderby('name','asc')->get();

        return view('admin.user.create')->with(compact('rols'));
    }

    public function store(UserStoreRequest $request)
	{	
		$user        = new User();
		$user->name  = $request->get('name');
		$user->email = $request->get('email');
		$password    = $request->get('password');
		
        if ($password)
        {
            $user->password = bcrypt($password);
        }

        $user->rol_id = $request->get('rol_id');
        $user->ucm    = auth()->user()->id;
		$user->save();

		return redirect()->route('user.index')->with('notification','Usuario ingresado exitosamente.');
    }
}
