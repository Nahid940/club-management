<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    //

    public function index()
    {
        return view('pages.notice.index',['title'=>""]);
    }

    public function add()
    {
        return view('pages.notice.add',['title'=>""]);
    }

    public function save(NoticeRequest $request)
    {
        Notice::create([
            "notice"=>$request->notice,
            "title"=>$request->title,
            "notice_date"=>$request->notice_date
        ]);
        return redirect()->back()->with('message','Notice posted successfully!!');
    }

}
