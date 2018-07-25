<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

    	return view('profile.edit', compact('user'));
    }

    public function update (Request $request) {
		if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","La contraseña que ingreso es incorrecta.");
		}
		
		if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","La nueva contraseña que ingreso es la misma a la anterior.");
		}
		
		$validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
		$user = auth()->user();
		$user->password = bcrypt($request->get('new-password'));
		$user->save();
		return redirect()->back()->with("success","La contraseña se cambio correctamente!");
    }
}
