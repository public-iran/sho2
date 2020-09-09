<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoapClient;
class Payment extends Model
{
    private $MerchantID;
    private $Amount;
    private $Description;
    private $CallbackURL;

    public function __construct($amount=null,$back=null)
    {
       // $this->MerchantID = '61f86243-47ca-4939-a2c2-3f25a6f7c8b4'; //Required
        $this->MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
        $this->Amount = $amount; // Amount will be based on Toman - Required
        $this->Description = 'فروشگاه اینترنتی'; // Required
        // $Email = 'UserEmail@Mail.Com'; // Optional
        // $Mobile = '09123456789'; // Optional
        $this->CallbackURL = 'http://127.0.0.1:8000/'.$back; // Required
    }

    public function doPayment()
    {
        //$client = new SoapClient('https://zarinpal.com/pg/posts/WebGate/wsdl', ['encoding' => 'UTF-8']);
       $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $this->Amount,
                'Description' => $this->Description,
                // 'Email' => $Email,
                // 'Mobile' => $Mobile,
                'CallbackURL' => $this->CallbackURL,
            ]
        );
        return $result;
    }

    public function verifyPayment($authority, $status)
    {
        if ($status == 'OK') {

       //     $client = new SoapClient('https://zarinpal.com/pg/posts/WebGate/wsdl', ['encoding' => 'UTF-8']);
            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $authority,
                    'Amount' => $this->Amount,
                ]
            );

            return $result;
        }else{
            return false;
        }
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
