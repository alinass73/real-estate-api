<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleVisitStoreRequest;
use App\Http\Resources\ScheduleResource;
use App\Http\Responses\Response;
use App\Models\ScheduleVisit;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleVisitController extends Controller
{
    public function store(ScheduleVisitStoreRequest $request)
    {
        $request->validated();

        try{
            
            $user_id=auth()->user()->id;
             
            $user_schedule=ScheduleVisit::where('visit_date',$request->visit_date)->get();
            $schedule_house=$user_schedule->where('real_estate_id',$request->real_estate_id)->count();
            // return $schedule_house;
            if($schedule_house>0)
            {
                $message="this appointment is already taken";
                $data=[];
                return Response::Error($data,$message);
            }


            $count=$user_schedule->where('user_id',$user_id)->count();
            if($count>0)
            {
                $message="you already get this appointment";
                $data=[];
                return Response::Error($data,$message);
            }
            // return
            $sch= auth()->user()->schedule()->create([
                'visit_date'=>$request->visit_date,
                'real_estate_id'=>$request->real_estate_id
            ]);
            $message="successfully";
            return Response::Success($sch,$message);
        }catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }
    
    
    public function index(){
        $schedule= ScheduleVisit::all();
        return ScheduleResource::collection($schedule);
    }
    
    public function indexOfMine()
    {
        $schedule= ScheduleVisit::where('user_id',auth()->user()->id)->paginate();
        return ScheduleResource::collection($schedule);
    }
    
    public function update(Request $request,ScheduleVisit $schedule)
    {
        
        $request->validate([
            'visit_date' => 'date|after:now|date_format:d-m-Y H:i|minute:00,30',
        ]);
        
        $schedule->update($request->all());
        return ScheduleResource::collection($schedule);
    }
    
}
