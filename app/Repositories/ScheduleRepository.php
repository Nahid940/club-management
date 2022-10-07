<?php
namespace app\Repositories;

use Illuminate\Support\Facades\DB;
use App\Interfaces\ScheduleInterface;

class ScheduleRepository implements ScheduleInterface
{

    public function getSchedule(int $id){

    }
    public function getSchedules(array $data){
        $schedules=DB::table('schedules')->select('id','title','date','month','year','time','object_data')
                    ->where('branch_id',$data['branch_id'])
                    ->where('user_id',$data['user_id'])
                    ->where('status',$data['status'])
                    ->orderBy('id','desc')
                    ->get();
        return $schedules;

    }
    public function addSchedule(array $data){

        $data=[
            "title" => $data['title'],
            "date" => $data['date'],
            "month" => $data['month'],
            "year" => $data['year'],
            "time" => $data['time'],
            "object_data" => $data['object_data'],
            "number_of_day" => $data['number_of_day'],
            "user_id" => $data['user_id'],
            "branch_id" => $data['branch_id'],
            "entry_by" => $data['entry_by'],
        ];

        DB::table('schedules')->insert($data);
        return true;

    }
    public function deleteSchedule(int $id){

    }
    public function updateSchedule(array $data){

    }
    public function getPostedData(object $request){
        $data['title'] =  $request['title'];
        $data['date'] =  $request['date'];
        $data['month'] =  $request['month'];
        $data['year'] =  $request['year'];
        $data['time'] =  $request['time'];
        $data['object_data'] = json_encode($request['object_data']);
        $data['number_of_day'] =  $request['number_of_day'];
        $data['user_id'] =  1;
        $data['branch_id'] =  1;
        $data['entry_by'] =  1;
        return $data;
    }

    public function getScheduleObjects($data)
    {
        $schedules=DB::table('schedules')->select('object_data')
                    ->where('branch_id',$data['branch_id'])
                    ->where('user_id',$data['user_id'])
                    ->where('status',$data['status'])
                    ->orderBy('id','desc')
                    ->get();
        
        $data=array();
        foreach($schedules as $key=>$schedule)
        {
            $data[$key]=json_decode($schedule->object_data);
        }
        return $data;
    }
    
}