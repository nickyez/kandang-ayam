<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeviceForUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $devices = Device::where('user_id',$userId)->get();
        return view('pages.devices_for_user.index',compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('is_admin',0)->get();
        return view('pages.devices_for_user.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->device_id;
        $find = Device::find($input);
        if(empty($find)){
            return redirect('/device/create')->with('status',"Device tidak ditemukan");
        }elseif($find->user_id == Auth::user()->id){
            return redirect('/device/create')->with('status',"Device sudah ada");
        }elseif($find->user_id != null && $find->user_id != Auth::user()->id){
            return redirect('/device/create')->with('status',"Device sudah digunakan");
        }
        $find->user_id = Auth::user()->id;
        $find->save();
        return redirect('/device')->with('status',"Device telah ditambahkan");
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        $device->user_id = null;
        $device->save();
        return redirect('/device')->with('Device telah dihapus dari kepemilikan');
    }
}
