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
            if($request->image){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('productImages'), $imageName);
                $intIsAdmin = intval($request->isAdmin);
                $criptedPassword = Hash::make($request->password);
                User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$criptedPassword,
                    'image'=>$imageName,
                    'isAdmin'=>$intIsAdmin
            ]);
            return redirect(route('admin.users'))->with('success', 'The user has been created with image');
            }
            else
            {
                $intIsAdmin = intval($request->isAdmin);
                $criptedPassword = Hash::make($request->password);
                User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$criptedPassword,
                    'isAdmin'=>$intIsAdmin
                ]);
                return redirect(route('admin.users'))->with('success', 'The user has been created without image');
            }
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
        $user = User::find($id);
        return view('back.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //dd($user);
        //$user = User::find($user->id);
        return view('back.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->password === $request->confirmPassword)
        {
            $user = User::find($id);
            if($request->image){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('productImages'), $imageName);
            }
            $request->validate([
                ///'image'=>'mimes:jpeg,png,jpg,gif',
                'email'=>'email|max:255',
            ]);
            $intIsAdmin = intval($request->isAdmin);
            $criptedPassword = Hash::make($request->password);
            $user->update([
                'name'=>$request->name,
                'password'=>$criptedPassword,
                'email'=>$request->email,
                'isAdmin'=>$intIsAdmin,
                'image'=>$imageName
            ]);
            return redirect(route('admin.users'))->with('success', 'The user has been updated');
        }
        else
        {
            return redirect()->back()->with('error', 'The password does not match');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect(route('admin.users'))->with('success', 'The user has been deleted');
    }
}
