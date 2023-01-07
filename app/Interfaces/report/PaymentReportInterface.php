<?php
/**
 * Created by PhpStorm.
 * User: nahid
 * Date: 1/7/23
 * Time: 11:40 PM
 */

namespace App\Interfaces\report;


interface PaymentReportInterface
{
    public function report($request);
}