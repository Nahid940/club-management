<?php
namespace App\Interfaces;

interface ScheduleInterface{
    public function getSchedule(int $id);
    public function getSchedules(array $data);
    public function addSchedule(array $data);
    public function deleteSchedule(int $id);
    public function updateSchedule(array $data);
    public function getPostedData(object $data);
}