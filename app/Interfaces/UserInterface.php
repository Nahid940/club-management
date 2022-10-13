<?php
namespace App\Interfaces;

interface UserInterface{
    public function getUser(int $id);
    public function getUsers(array $data);
    public function addUser(array $data);
    public function deleteUser(int $id);
    public function updateUser(array $data);
    public function getPostedData(object $data);
}