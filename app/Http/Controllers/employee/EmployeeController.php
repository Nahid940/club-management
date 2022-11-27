<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $pageTitle="Employees";
        $data['branch_id']=1;
        return view('pages.employee.index',['title' => $pageTitle]);
    }
}
