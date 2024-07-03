<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // "SELECT * FROM users"

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $foto = $request->file('foto');
        $nama_foto = time() . rand(1, 9) . '.' . $foto->getClientOriginalExtension();
        $foto->move('user_images', $nama_foto);
        $data['foto'] = $nama_foto;

        User::create($data); // "INSERT INTO users VALUES(......."

        session()->flash('message', 'Data user berhasil ditambah!');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        $data = $request->all();
        if ($request->password) {

            $request->validate([
                'password' => 'required|confirmed',
            ]);

            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->has('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . rand(1, 9) . '.' . $foto->getClientOriginalExtension();
            $foto->move('user_images', $nama_foto);
            $data['foto'] = $nama_foto;
        }

        $user->update($data); // "UPDATE users SET ...."

        session()->flash('message', 'Data user berhasil diedit!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('message', 'Data user berhasil dihapus!');
        return redirect()->route('users.index');
    }
}
