<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 12/11/22
 * Time: 9:40 PM
 */

namespace App\Repositories;


use App\Interfaces\UserRole;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRoleRepository implements UserRole
{

    public function getRoles(array $cond)
    {
        $roles=DB::table('roles')->paginate(10);
        return $roles;
    }

    public function getRole($id)
    {
        // TODO: Implement getRole() method.
    }

    public function deleteRole($id)
    {
        // TODO: Implement deleteRole() method.
    }

    public function updateRole($id)
    {
        // TODO: Implement updateRole() method.
    }

    public function assignRolePermission(array $data)
    {
        // TODO: Implement assignRolePermission() method.
    }

    public function deleteRolePermission(array $data)
    {
        // TODO: Implement deleteRolePermission() method.
    }
}