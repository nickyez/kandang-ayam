<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Device;
use Carbon\Carbon;

class APIController extends Controller
{
    public function postSuhu(Request $request, $id)
    {
        $query = DB::table('temp_data');
        $search = Device::find($id);
        if(empty($search)){
            return response([
                'status'=>"error",
                'message'=>"device not found"
            ],404);
        }
        if(empty($request->temp) || empty($request->humi)){
            return response([
                'status'=>"error",
                'message'=>"bad request"
            ],400);
        }
        if (is_int($request->temp) && is_int($request->humi)){
            $query->insert([
                'id'=>$id,
                'temp'=>$request->temp,
                'humi'=>$request->humi,
            ]);
            return response([
                'status'=>"success",
                'message'=>"data created"
            ],201);
        }
        return response([
            'status'=>"error",
            'message'=>"Data is not integer"
        ],400);
    }

    public function getLampStatus($id)
    {
        $searchDevice = Device::find($id);
        if(empty($searchDevice)){
            return response([
                'status'=>"error",
                'message'=>"Device not found"
            ],404);
        }

        /**
        * * 0 = Otomatis (by sensor)
        * * 1 = Manual (by time)
        */
        $query = DB::table('lamp_status')->where('id',$id);
        $lamp = $query->first();
        if($lamp->mode == 1){
            $dt = Carbon::now()->format('H:i:s');
            if($lamp->time_on <= $dt && $lamp->time_off >= $dt){
                $query->update([
                    'status'=>1,
                ]);
            }else{
                $query->update([
                    'status'=>0,
                ]);
            }
        }else{
            $suhu = DB::table('temp_data')->where('id',$id)->orderBy('waktu','desc')->first();
            if($lamp->suhu_nyala <= $suhu->temp && $lamp->suhu_mati >= $suhu->temp){
                $query->update([
                    'status'=>1,
                ]);
            }else{
                $query->update([
                    'status'=>0,
                ]);
            }
        }
        $lamp = $query->first();
        return response([
            'status'=>"success",
            'message'=>"Data get succesfuly",
            'data'=>[
                'id'=>$id,
                'status'=>$lamp->status,
                'mode'=>$lamp->mode
            ]
        ]);
    }
}
