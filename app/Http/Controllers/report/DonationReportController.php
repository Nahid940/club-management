<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Services\DonationReportService;
use Illuminate\Http\Request;

class DonationReportController extends Controller
{
    //

    protected $donationReportService;

    public function __construct(DonationReportService $donationReportService)
    {
        $this->donationReportService=$donationReportService;
    }

    public function index()
    {
        return view('reports.donation.index',['title'=>""]);
    }

    public function report(Request $request)
    {
        $date_from=$request->date_from;
        $date_to=$request->date_to;
        $data=$this->donationReportService->report($request);
        return response()->json([
            'html' => view('reports.donation.report',["payments"=>$data,'date_from'=>$date_from,'date_to'=>$date_to])->render()
        ]);
    }

}
