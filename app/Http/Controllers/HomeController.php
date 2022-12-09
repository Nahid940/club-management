<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    //

    public function index()
    {
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'add members']);
        $user = User::where(['email' => 'nahid940@gmail.com'])->first();
        $user->assignRole('admin');

        $role = Role::findByName('admin');
        // Permission::create(['name' => 'view members']);
        // $role->givePermissionTo('add members');
        $role->givePermissionTo('view members');



        // $role->givePermissionTo('add members');
        // $permissions = $user->permissions;echo "<pre>";print_r($permissions);die;
        $pageTitle="Dashboard";
        return view('pages.home',['title'=>$pageTitle]);
    }

}
