<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    //

    public function index()
    {
        $occupations=Occupation::select('id','occupation')->get();
        return view('pages.member.occupation',['occupations'=>$occupations,'title'=>""]);
    }

    public function add()
    {
        return view('pages.member.add-occupation',['title'=>""]);
    }

    public function save(Request $request)
    {
        $request->validate([
            "occupation"=>"required|max:45"
        ]);
        Occupation::create($request->all());
        return redirect()->back()->with('message','Data saved successfully!!');
    }

    public function edit($id)
    {
        $occupation=Occupation::where('id',$id)->first();
        return view('pages.member.occupation-edit',['occupation'=>$occupation]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "id"=>"required",
            "occupation"=>"required|max:45"
        ]);
        Occupation::where('id',$request->id)->update(['occupation'=>$request->occupation]);
        return redirect()->back()->with('message','Data saved successfully!!');
    }

    public function delete(Request $request)
    {
        Occupation::where('id',$request->id)->delete();
        return redirect()->back()->with('message','Data deleted successfully!!');
    }
}
