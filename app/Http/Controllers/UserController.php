<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    //

    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user=$user;
    }

    public function index()
    {

    }

    public function add()
    {
        $pageTitle="Add new user";
        return view('pages.user.add',['title'=>$pageTitle]);
    }

    public function save(UserRequest $reuquest)
    {
        dd($reuquest);
    }

}
