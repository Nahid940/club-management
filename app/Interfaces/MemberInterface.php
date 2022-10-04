<?php
namespace App\Interfaces;

interface MemberInterface{
    public function getMember(int $id);
    public function getMembers(array $data);
    public function addMember(array $data);
    public function deleteMember(int $id);
    public function updateMember(array $data);
    public function getPostedData(object $data);
}