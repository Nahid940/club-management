<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    //

    public function index(Request $request)
    {
        if(!empty($request->title))
        {
            $notices=Notice::with('createdBy')
                ->where('title','LIKE','%'.$request->title.'%')
                ->orderBy('id','desc')->paginate(20);
        }else
        {
            $notices=Notice::with('createdBy')
                ->orderBy('id','desc')->paginate(20);
        }

        return view('pages.notice.index',['title'=>"",'notices'=>$notices]);
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
            "notice_date"=>$request->notice_date,
            "created_by"=>Auth::user()->id,
        ]);
        return redirect()->back()->with('message','Notice posted successfully!!');
    }

}
