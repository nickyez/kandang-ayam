<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Device;

class AuthController extends Controller
{
    public function index(){
        return view('pages.login');
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('username', 'password'))){
            $devices = Device::where('user_id',Auth::user()->id)->first();
            if(!empty($devices)){
                $request->session()->put('device', $devices->id);
                return redirect('/?d='.$devices->id);
            }
            return redirect('/');
        }
        return redirect()->route('login')->with('status','Username dan Password salah');
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
