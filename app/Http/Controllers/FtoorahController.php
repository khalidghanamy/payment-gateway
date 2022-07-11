<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahServices;
use Illuminate\Http\Request;

class FtoorahController extends Controller
{

    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    
    }
    public function payOrder(){
        $data =[
            'CustomerName'=>'test',
            'CustomerEmail'=>'khalid.gamal.hamed@gmail.com',
            'CustomerPhone'=>'01005712097',
            'NotificationOption'=>'LNK',
            'InvoiceValue'=>100,
            'CallbackURL'=>env('SUCCESS_URL'),
            'ErrorURL'=>env('ERROR_URL'),
            'Language'=>'en',
            'DisplayCurrencyIso'=>'SAR',
        ];

       $response= $this->fatoorahServices->sendPayment($data);
         return $response;


    }


    public function callback(Request $request){

        $data=[
            'key'=>$request->paymentId,
            'KeyType'=>'PaymentId',
        ];
        $this->fatoorahServices->getPaymentStatus($data);

    }

    public function error(){

        return 'error';
    }
}
