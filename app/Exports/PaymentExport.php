<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    public function headings(){
        return[
            'Name',
            'Member Code',
            'Amount',
            'Payment Date',
            'Payment Month',
            'Payment Year',
            'Reference No',
            'Remarks'
        ];
    }

    public function collection()
    {
        return collect($this->data);
    }


}
