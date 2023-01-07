<?php

namespace App\Http\Controllers;

use App\Models\MemberClassification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberClassificationController extends Controller
{
    //

    public function index()
    {
        $classifications=MemberClassification::select('id','name')->where('status',1)->paginate(10);
        return view('pages.member.classification',["classifications"=>$classifications,"title"=>""]);
    }

    public function add(Request $request)
    {
        if(!empty($request->name))
        {
            MemberClassification::create(['name'=>$request->name,'created_by'=>Auth::user()->id,'created_at'=>Carbon::now()]);
            return redirect()->back()->with('message',"Data added successfully!!");
        }
    }

    public function edit($id)
    {
        $class=MemberClassification::where('id',$id)->first();
        return view('pages.member.class-edit',['class'=>$class,"title"=>""]);
    }

    public function update(Request $request)
    {
        MemberClassification::where('id',$request->id)->update(['name'=>$request->name]);
        return redirect()->back()->with('message',"Data updated successfully!!");
    }

    public function save(Request $request)
    {
        DB::table('member_has_member_classifications')->where('member_id',$request->member_no)->delete();
        if(!empty($request->classifications))
        {
            foreach($request->classifications as $classification)
            {
                DB::table('member_has_member_classifications')
                    ->insert([
                        'member_id'=>$request->member_no,
                        'member_classifications_id'=>$classification,
                    ]);
            }
        }

        return redirect()->back()->with('message',"Data updated successfully!!");
    }

    public function delete(Request $request)
    {
        MemberClassification::where('id',$request->id)->update(['status'=>0]);
        return redirect()->back()->with('message',"Data deleted successfully!!");
    }
}
