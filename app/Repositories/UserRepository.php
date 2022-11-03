<?php
namespace app\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

    public function getUser(int $id){

    }
    public function getUsers(array $data){

    }
    public function addUser(array $data){

    }
    public function deleteUser(int $id){

    }
    public function updateUser(array $data){

    }
    public function getPostedData(object $data){
        dd($data);
    }
    public function updatePassword(object $data){
        $auth = Auth::user();
        if (!Hash::check($data->get('current_password'), $auth->password)) 
        {
            return "Current Password is Invalid";
        }
        if (strcmp($data->get('current_password'), $data->new_password) == 0) 
        {
            return "New Password cannot be same as your current password.";
        }
        $user = User::find($auth->id);
        $user->password =  Hash::make($data->new_password);
        $user->save();
        return "Password Changed Successfully";
    }

}