<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    //


    private $user_role;

    public function __construct(UserRole $user_role)
    {
        $this->user_role=$user_role;
    }

    public function index()
    {
        $roles=$this->user_role->getRoles(array());
        $pageTitle="User Role";
        return view('pages.user_role.roles',['title'=>$pageTitle])->with(['roles'=>$roles]);
    }
}
