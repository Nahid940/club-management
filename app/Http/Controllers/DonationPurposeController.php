<?php

namespace App\Http\Controllers;

use App\Models\DonationPurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationPurposeController extends Controller
{
    //

    public function index()
    {
        $purposes=DonationPurpose::select('id','purpose','created_at','status')->where('status',1)->orderBy('id','desc')->paginate(10);
        return view('pages.donation.purpose-index',["title"=>"","purposes"=>$purposes]);
    }


    public function add()
    {
        return view('pages.donation.purpose-add',["title"=>""]);
    }

    public function edit(Request $request,$id)
    {
        $purpose=DonationPurpose::where('id',$id)->first();
        return view('pages.donation.purpose-edit',["title"=>"","purpose"=>$purpose]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "purpose"=>"required|max:45",
            "id"=>"required"
        ]);
        $purpose=DonationPurpose::where('id',$request->id)->update(['purpose'=>$request->purpose,'updated_by'=>Auth::user()->id]);
        return redirect()->back()->with('message','Purpose Updated Successfully!');
    }

    public function save(Request $request)
    {
        $request->validate([
            "purpose"=>"required|max:50"
        ]);
        DonationPurpose::create(['purpose'=>$request->purpose,'created_by'=>Auth::user()->id]);
        return redirect()->back()->with('message','Purpose Added Successfully!');
    }

    public function delete(Request $request)
    {
        if(!empty($request->id)) {
            DonationPurpose::where('id', $request->id)->update(['status' => -2]);//delete
            return redirect()->back()->with('message','Purpose deleted successfully!!');
        }
    }
}
