<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();
        return view('pages.devices.index',compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('is_admin',0)->get();
        return view('pages.devices.create',compact('users'));
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
            'device_id'=>'max:8'
        ]);
        $device = new Device;
        $device->id = $request->device_id;
        if(!empty($request->user)){
            $device->user_id = $request->user;
        }
        $device->save();
        return redirect('/devices')->with('status','Data berhasil ditambahkan');
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
        $device = Device::find($id);
        $users = User::where('is_admin',0)->get();
        return view('pages.devices.edit',compact('device','users'));
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
        $request->validate([
            'device_id'=>'max:8'
        ]);
        $device = Device::find($id);
        $device->id = $request->device_id ? $request->device_id : $device->id;
        if(!empty($request->user)){
            $device->user_id = $request->user ? $request->user : $device->user;
        }else{
            $device->user_id = null;
        }
        $device->save();
        return redirect('/devices')->with('status','Data berhasil diubah');
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
        $device->delete;
        return redirect('/devices')->with('Data berhasil dihapus');
    }
}
