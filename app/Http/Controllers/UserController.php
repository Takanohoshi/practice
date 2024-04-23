<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.datauser.index', compact('users'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create | User';
        return view('admin.datauser.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => ['required', 'min:8', 'max:32', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')],
            'namalengkap' => ['required', 'max:255'],
            'alamat' => ['required', 'max:255'],
            'level' => ['required', Rule::in(['admin', 'petugas'])],
        ];
        
        $validatedData = $request->validate($rules);
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        User::create($validatedData);
        
        return redirect('/dashboard/datauser')->with('success', 'user baru telah dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.datauser.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->namalengkap = $request->namalengkap;
        $user->alamat = $request->alamat;
        $user->level = $request->level;
        $user->save();
    
        return redirect()->route('datauser.index')->with('success', 'user diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('datauser.index')->with('success', 'user berhasil dihapus');
    }
}

