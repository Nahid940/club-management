<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use Carbon\Carbon;
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

    public function view($id)
    {
        $notice=Notice::with('createdBy')->where('id',$id)->first();
        return view('pages.notice.view',['title'=>"",'notice'=>$notice]);
    }

    public function edit($id)
    {
        $notice=Notice::findOrFail($id);
        return view('pages.notice.edit',['title'=>"",'notice'=>$notice]);
    }

    public function update(NoticeRequest $request)
    {
        Notice::where('id',$request->id)->update([
            "notice"=>$request->notice,
            "title"=>$request->title,
            "notice_date"=>$request->notice_date,
            "updated_at"=>Carbon::now(),
            "updated_by"=>Auth::user()->id
        ]);
        return redirect()->back()->with('message','Notice updated successfully!!');
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

    public function delete(Request $request)
    {
        Notice::where('id',$request->notice_id)->delete();
        return redirect()->back()->with('message','Notice deleted successfully!!');
    }

    public function postpone(Request $request)
    {
        if($request->status==1)
        {
            Notice::where('id',$request->n_id)->update(["status"=>0]);
            return redirect()->back()->with('message','Notice postponed successfully!!');
        }else
        {
            Notice::where('id',$request->n_id)->update(["status"=>1]);
            return redirect()->back()->with('message','Notice postponed successfully!!');
        }
    }

}
