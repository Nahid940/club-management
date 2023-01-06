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
}
