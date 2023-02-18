<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Interfaces\report\PaymentReportInterface;
use App\Models\DonationPurpose;
use App\Models\Member;
use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentReportController extends Controller
{
    //

    protected $reportRepo;

    public function __construct(PaymentReportInterface $reportRepo)
    {
        $this->reportRepo=$reportRepo;
    }

    public function index()
    {
        $members=Member::select('id','first_name','member_code')->where('status',1)->get();
        $purposes=DonationPurpose::select('id','purpose')->where('status',1)->get();
        $paymentTypes=PaymentType::select('id','name')->where('status',1)->get();
        return view('reports.payment.payment-report-index',['title'=>"","purposes"=>$purposes,'members'=>$members,'paymentTypes'=>$paymentTypes]);
    }

    public function report(Request $request)
    {
        $payments_data=$this->reportRepo->report($request);
        $date_from=$request->date_from;
        $date_to=$request->date_to;
        $purpose=null;
        if(!empty($request->purpose))
        {
            $purpose=DonationPurpose::select('id','purpose')->where('id',$request->purpose)->first();
        }
        return response()->json([
            'html' => view('reports.payment.payment-report',["payments"=>$payments_data,'date_from'=>$date_from,'date_to'=>$date_to,'purpose'=>$purpose])->render()
        ]);
    }
}
