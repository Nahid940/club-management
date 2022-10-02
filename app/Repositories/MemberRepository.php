<?php
namespace app\Repositories;

use App\Interfaces\MemberInterface;

class MemberRepository implements MemberInterface
{

    public function getMember(int $id){
        echo $id;
    }

    public function getMembers(array $data){

    }

    public function addMember(array $data){

    }

    public function deleteMember(int $id){

    }

    public function updateMember(array $data){

    }
    
}