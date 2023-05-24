<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\DueCalculationService;
use App\Mail\MonthlyPaymentNoticeMail;
use Illuminate\Support\Facades\Mail;

class MonthlyPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:monthly_payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monthly Payment Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(DueCalculationService $due)
    {
        $members=DB::table('members')->where('status',1)->select('id','email')->get();
        foreach($members as $member)
        {
            if(!empty($member->email))
            {
                $member_id=$member->id;
                $member_due=$due->getDueOfMemberForMonthlyMail($member_id);
                if($member_due['membership_fee_due']>0|| $member_due['monthly_fee_due']>0)
                {
                    Mail::to($member->email)->queue(new MonthlyPaymentNoticeMail($member_due));
                }
            }
        }

        // Mail::to("nahid940@gmail.com")->queue(new MonthlyPaymentNoticeMail([
        //         "membership_fee_due"=>500,
        //         "monthly_fee_due"=>5008,
        //         "member_name"=>"Nahid",
        //         "code"=>50333,
        //     ])
        // );
    }
}
