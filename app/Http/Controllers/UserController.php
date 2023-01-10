<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $users=User::select('id','name','email','status','created_at')->where('user_type',1)->paginate(10);
        return view('pages.user.index',['title'=>"","users"=>$users]);
    }

    public function add()
    {
        $pageTitle="Add new user";
        return view('pages.user.add',['title'=>$pageTitle]);
    }

    public function save(UserRequest $request)
    {
        $user=User::create(array_merge($request->all(), [ 'password' => bcrypt($request->input('password')) ]));
        $user->assignRole($request->role_id);
        return redirect()->back()->with('message','User added successfully!!');
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

    public function delete(Request $request)
    {
        if(!empty($request->user_id)) {
            User::where('id', $request->user_id)->update(['status' => -2]);//delete
            return redirect()->back()->with('message','User deleted successfully!!');
        }
    }

    public function statusChange(Request $request)
    {
        if(!empty($request->status) && $request->status==1) {
            User::where('id', $request->user_id)->update(['status' => 0]);
            return redirect()->back()->with('message','User inactivated successfully!!');
        }else if(!empty($request->status) && $request->status==1)
        {
            User::where('id', $request->user_id)->update(['status' => 1]);
            return redirect()->back()->with('message','User activated successfully!!');
        }
    }
}
