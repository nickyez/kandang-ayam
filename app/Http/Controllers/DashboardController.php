<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Show devices
        $userId = Auth::user()->id;
        $devices = Device::where('user_id',$userId)->get();

        // Show Data
        if(!empty($request->d)){
            $findDevice = Device::find($request->d);
            $getLastTempData= DB::table('temp_data')->where('id',$request->d)->orderBy('waktu','desc')->get();
            $getLastLampStatus= DB::table('lamp_status')->where('id',$request->d)->first();
            return view('pages.dashboard.index', compact('devices','getLastTempData','getLastLampStatus'));
        }

        return view('pages.dashboard.index', compact('devices'));
    }

    public function addDevice(Request $request)
    {
        $input = $request->device_id;
        $find = Device::find($input);
        if(empty($find)){
            return redirect('/')->with('message',"Device tidak ditemukan");
        }elseif($find->user_id == Auth::user()->id){
            return redirect('/')->with('message',"Device sudah ada");
        }elseif($find->user_id != null && $find->user_id != Auth::user()->id){
            return redirect('/')->with('message',"Device sudah digunakan");
        }
        $find->user_id = Auth::user()->id;
        $find->save();
        return redirect('/')->with('message',"Device telah ditambahkan");
    }
}
