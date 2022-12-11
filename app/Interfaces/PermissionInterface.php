<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 12/11/22
 * Time: 10:46 PM
 */

namespace App\Interfaces;


interface PermissionInterface
{
    public function getPermissions(array $data);
    public function getPermission($id);
    public function editPermission($id);
    public function deletePermission($id);
    public function assignPermission(array $permissions,$role_id);
}