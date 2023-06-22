<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserPill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PillController extends Controller
{

    function index(){
        $user = Auth::guard('api')->user();
        $user_id = $user['id'] ?? 0;
        $pills = UserPill::where('user_id',$user_id)->get();
        foreach ($pills as $k=>$pill)
        {
            $pills[$k]['treatment_start_time'] = date('Y/m/d H:i',$pills[$k]['treatment_start_time']);
        }
        return [
            'success'=>true,
            'message'=>'welcome',
            'data'=>$pills
        ];
    }

    function create(Request $request){
        $user = Auth::guard('api')->user();
        $user_id = $user['id'] ?? 0;
        $title = $request->post('title');
        $title = strip_tags($title);
        $consumption_period = $request->post('consumption_period');
        $treatment_start_time = $request->post('treatment_start_time');
        $treatment_start_time = strip_tags($treatment_start_time);
        $treatment_duration = $request->post('treatment_duration');
        //check validation
        if($title==null || strlen(trim($title)) ==0)
        {
            return [
                'success'=>false,
                'message'=>'please enter title',
                'data'=>[]
            ];
        }
        $pill = new UserPill();
        $pill->title = $title;
        $pill->user_id = $user_id;
        $pill->consumption_period = intval($consumption_period);
        $pill->treatment_start_time = strtotime($treatment_start_time);
        $pill->treatment_duration = intval($treatment_duration);
        $pill->next_remind_time = intval($treatment_start_time);
        $pill->status = 1;
        $pill->save();

        return [
            'success'=>true,
            'message'=>'welcome',
            'data'=>$pill
        ];
    }

}
