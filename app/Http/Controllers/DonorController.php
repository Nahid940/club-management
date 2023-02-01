<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonorRequest;
use App\Models\Donor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    //

    public function index()
    {
        $donors=Donor::where('status',1)->paginate(10);
        return view('pages.donation.donors',["title"=>"","donors"=>$donors]);
    }

    public function search(Request $request)
    {
        if(empty($request->value)) return false;
        $members=Donor::where('name','LIKE',"%$request->value%")->where('status',1)->select('id','name','email')->get();
        return json_encode(["members"=>$members]);
    }

    public function donorAdd(DonorRequest $request)
    {
        $id=Donor::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "origin"=>$request->origin,
            "donor_type"=>$request->donor_type,
            "reference_person_phone"=>$request->reference_person_phone,
            "reference_person_name"=>$request->reference_person_name,
            "address"=>$request->address,
            "created_at"=>Carbon::now(),
            "created_by"=>Auth::user()->id,
        ])->id;
        return json_encode(['id'=>$id]);
    }


    public function delete(Request $request)
    {
        if(!empty($request->donor_id)) {
            Donor::where('id', $request->donor_id)->update(['status' => -2]);//delete
        }
        return redirect()->back()->with('message','Donor data moved to trash!');
    }

    public function edit($id)
    {
        $donor=Donor::findOrFail($id);
        return view('pages.donation.donor-edit',["title"=>"","donor"=>$donor]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "phone"=>"required",
            "email"=>"required",
        ]);
        Donor::where('id',$request->id)->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "origin"=>$request->origin,
            "donor_type"=>$request->donor_type,
            "reference_person_phone"=>$request->reference_person_phone,
            "reference_person_name"=>$request->reference_person_name,
            "address"=>$request->address,
            "updated_at"=>Carbon::now(),
            "updated_by"=>Auth::user()->id,
        ]);

        return redirect()->back()->with('message','Donor data updated successfully!');
    }

    public function addDonor()
    {
        return view('pages.donation.add-donor',['title'=>""]);
    }

    public function donorSave(DonorRequest $request)
    {
        $request->validate([
            "name"=>"required|max:70",
            "email"=>"max:50",
            "phone"=>"max:20",
            "donor_type"=>"max:20",
            "reference_person_phone"=>"max:30",
            "reference_person_name"=>"max:30",
            "address"=>"max:70"
        ]);
        Donor::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "origin"=>$request->origin,
            "donor_type"=>$request->donor_type,
            "reference_person_phone"=>$request->reference_person_phone,
            "reference_person_name"=>$request->reference_person_name,
            "address"=>$request->address,
            "created_at"=>Carbon::now(),
            "created_by"=>Auth::user()->id,
        ]);

        return redirect()->back()->with('message','Data saved successfully!!');

    }

}
