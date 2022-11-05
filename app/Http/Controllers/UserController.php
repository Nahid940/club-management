<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user=$user;
    }

    public function index()
    {

    }

    public function add()
    {
        $pageTitle="Add new user";
        return view('pages.user.add',['title'=>$pageTitle]);
    }

    public function save(UserRequest $reuquest)
    {
        dd($reuquest);
    }

    public function updatePassword(Request $request)
    {
        $pageTitle="Password update";
        if ($request->isMethod('post'))
        {
            $request->validate([
                "current_password"=>"required",
                "new_password"=>"required|confirmed",
            ]);
            $message=$this->user->updatePassword($request);
            return redirect()->route('password-update')->with(['message'=>$message]);
        }
        if ($request->isMethod('get'))
        {
            return view('pages.user.password_update',['title'=>$pageTitle]);
        }
    }
}
