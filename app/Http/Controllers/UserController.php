<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('back.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->password === $request->confirmPassword)
        {
            $request->validate([
                'name'=>'required|string|max:255',
                'email'=>'required|email|max:255|unique:users,email',
                'password'=>'required|min:8|max:255',
                'confirmPassword'=>'required|min:8|max:255'
            ]);
            $intIsAdmin = intval($request->isAdmin);
            $criptedPassword = Hash::make($request->password);
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$criptedPassword,
                'isAdmin'=>$intIsAdmin
            ]);
            return redirect(route('admin.users'))->with('succes', 'The user has been created');
        }
        else
        {
            return redirect()->back()->with('error', 'The password does not match');
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
