<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Interfaces\report\PaymentReportInterface;
use App\Models\Payment;
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
        return view('reports.payment.payment-report-index',['title'=>""]);
    }

    public function report(Request $request)
    {
        $payments_data=$this->reportRepo->report($request);
        $date_from=$request->date_from;
        $date_to=$request->date_to;
        return response()->json([
            'html' => view('reports.payment.payment-report',["payments"=>$payments_data,'date_from'=>$date_from,'date_to'=>$date_to])->render()
        ]);
    }
}
