<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 12/11/22
 * Time: 9:34 PM
 */

namespace App\Interfaces;


interface UserRole
{
    public function getRoles(array $cond);
    public function getRole($id);
    public function deleteRole($id);
    public function updateRole($id);
    public function assignRolePermission(array $data);
    public function deleteRolePermission(array $data);
}