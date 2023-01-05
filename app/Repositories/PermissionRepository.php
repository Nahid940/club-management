<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 12/11/22
 * Time: 10:47 PM
 */

namespace App\Repositories;


use App\Interfaces\PermissionInterface;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements PermissionInterface
{

    public function getPermissions(array $data)
    {
        $permissions=DB::table('permissions')->select('id','name','module_name')->orderBy('serial','asc')->get();
        $list=array();
        foreach ($permissions as $permission)
        {
            $action_array=explode(" ",$permission->name);
            $list[$permission->module_name][$permission->id]['id'] =$permission->id;
            $list[$permission->module_name][$permission->id]['name'] =$permission->name;
            $list[$permission->module_name][$permission->id]['action']=$action_array[0];
        }
        return $list;
    }

    public function getPermission($id)
    {
        // TODO: Implement getPermission() method.
    }

    public function editPermission($id)
    {

    }

    public function getRolePermissions($role_id)
    {
        $permissions=DB::table('role_has_permissions')->where('role_id',$role_id)->get();
        $array=array();
        foreach ($permissions as $permission)
        {
            $array[$permission->permission_id]=$permission->permission_id;
        }
        return $array;
    }

    public function deletePermission($id)
    {
        DB::table('role_has_permissions')->where('role_id',$id)->delete();
    }

    public function assignPermission(array $permissions,$role_id)
    {
        foreach($permissions as $permission)
        {
            DB::table('role_has_permissions')
                ->insert([
                    'permission_id'=>$permission,
                    'role_id'=>$role_id,
                ]);
        }
    }
}