<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LampController extends Controller
{   
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $devices = Device::where('user_id',$userId)->get();

        if(!empty($request->d)){
            $findDevice = Device::find($request->d);
            $getLastLampStatus= DB::table('lamp_status')->where('id',$request->d)->first();
            return view('pages.controls.lampu', compact('devices','getLastLampStatus'));
        }
        return view('pages.controls.lampu', compact('devices'));
    }

    public function addDevice(Request $request)
    {
        $input = $request->device_id;
        $find = Device::find($input);
        if(empty($find)){
            return redirect('/kontrol-lampu?d='.session()->get('device'))->with('message',"Device tidak ditemukan");
        }elseif($find->user_id == Auth::user()->id){
            return redirect('/kontrol-lampu?d='.session()->get('device'))->with('message',"Device sudah ada");
        }
        $find->user_id = Auth::user()->id;
        $find->save();
        return redirect('/kontrol-lampu')->with('message',"Device telah ditambahkan");
    }

    public function update(Request $request,$id)
    {
        $lamp = DB::table('lamp_status');
    }
}
