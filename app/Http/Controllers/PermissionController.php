<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //

    private $permission;

    public function __construct(PermissionInterface $permission)
    {
        $this->permission=$permission;
    }

    public function index(Request $request)
    {
        $pageTitle="";
        $permissions=$this->permission->getPermissions(array());
        $role_id=$request->role_id;
        $role_name=$request->role_name;
        $role_permissions=$this->permission->getRolePermissions($role_id);
        return view('pages.permission.permissions',['title' => $pageTitle,'permissions'=>$permissions,'role_id'=>$role_id,'role_name'=>$role_name,'role_permissions'=>$role_permissions]);
    }

    public function getAllPermissions()
    {

    }

    public function assignPermission(Request $request)
    {
        $this->permission->deletePermission($request->role_id);
        if(!empty($request->permissions))
        {
            $this->permission->assignPermission($request->permissions,$request->role_id);
        }
        return redirect()->route('permission-index',['role_id'=>$request->role_id,'role_name'=>$request->role_name])->with('message','Permission assigned successfully!!');

    }
}
