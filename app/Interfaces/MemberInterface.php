<?php
namespace App\Interfaces;

interface MemberInterface{
    public function getMember($id);
    public function getProfile($id);
    public function getMembers(array $data);
    public function addMember(array $data);
    public function deleteMember($id);
    public function updateMember(array $data);
    public function updateProfile(object $data);
    public function getPostedData(object $data);
}