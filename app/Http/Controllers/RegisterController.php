<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);

        // Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validacion
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|max:20',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:6'
        ],[
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre es demasiado largo',
            'username.required' => 'El nombre de usuario es obligatorio',
            'username.unique' => 'El nombre de usuario ya existe',
            'username.max' => 'El nombre de usuario es demasiado largo',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya existe',
            'email.email' => 'El email no es válido',
            'email.max' => 'El email es demasiado largo',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres'
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // for ($i = 1; $i <= 5; $i++) {
        //   if ($i != $user->id && User::where('id', $i)->exists()) {
        //        Follower::create([
        //            'user_id' => $i,
        //            'follower_id' => $user->id
        //        ]);
        //    }
        //}
        $follow = Follower::create([
            'user_id' => 1, // ID del usuario recién creado
            'follower_id' => $user->id // ID del usuario por defecto a seguir
        ]);

        // Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar
        return redirect()->route('posts.index', ['user' => $user]);
    }
}
