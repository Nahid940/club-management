<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class MemberBookController extends Controller
{
    //

    public function index()
    {

        $members=Member::select('first_name','last_name','member_code','member_photo','member_type','blood_group',
            'email','mobile_number','phone_number','present_address','permanent_address')->paginate(20);
        return view('pages.member.book',["members"=>$members,"title"=>""]);
    }

    public function pdf()
    {
        $members=Member::select('first_name','last_name','member_code','member_photo','member_type','blood_group',
            'email','mobile_number','phone_number','present_address','permanent_address')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.member.pdf-book',compact('members'));
        return $pdf->stream('member_book.pdf');

    }
}
