<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only('name', 'email'));
        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado con éxito.');
    }
}
