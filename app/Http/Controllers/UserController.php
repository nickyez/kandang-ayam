<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'username'=>'required|max:8|alpha_num',
        ]);
        $user = new User;
        if(!empty($request->photo)){
            $user->photos_url = $request->file('photo')->store('profile','public');
        }else{
            $user->photos_url = "profile/undraw_profile.svg";
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->is_admin = 0;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/users')->with('status','User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(!empty($request->photo)){
            $user->photos_url = $request->file('photo')->store('profile','public');
        }
        $user->name = $request->name ? $request->name : $user->name;
        $user->username = $request->username ? $request->username : $user->username;
        $user->email = $request->email ? $request->email : $user->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect('users')->with('status', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $filename = $user->photos_url;
        if($filename != "profile/undraw_profile.svg"){
            File::delete(public_path($filename));
        }
        $user->delete();
        return redirect('/users')->with('status','User berhasil di hapus!');
    }
}
