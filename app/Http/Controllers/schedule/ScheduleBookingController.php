<?php

namespace App\Http\Controllers\schedule;
use App\Http\Controllers\Controller;
use App\Interfaces\ScheduleInterface;
use App\Http\Requests\ScheduleRequest;
use App\Providers\ScheduleServiceProvider;

class ScheduleBookingController extends Controller
{
    //
    private $scheule;

    public function __construct(ScheduleInterface $schedule)
    {
        $this->schedule=$schedule;
    }

    public function view()
    {
        $pageTitle="Schedule Plan";
        $schedules=$this->schedule->getSchedules(['branch_id'=>1,"user_id"=>1,"status"=>1]);
        return view('pages.schedule.view',['title'=>$pageTitle,'schedules'=>$schedules]);
    }

    public function addSchedule(ScheduleRequest $request)
    {
        $data=$this->schedule->getPostedData($request);
        $this->schedule->addSchedule($data);
        echo json_encode(["status"=>200,"message"=>"Schedule added successfully!"]);
        return;
    }

    public function getScheduleForCalender()
    {
        $eventObject=$this->schedule->getScheduleObjects(['branch_id'=>1,"user_id"=>1,"status"=>config('status_code.ACTIVE_SCHEDULE_STATUS')]);
        return $eventObject;
    }
}
