<?php 

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;




class FatoorahServices{

    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('FATOORA_BASE_URL');
        $this->headers =[
            'content-type'=>'application/json',
            'authorization'=>'Bearer '.env('FATOORA_TEST_TOKEN'),
        ];
    }

    public function buildRequest($uri,$method, $data = []){
        $request = new Request($method, $this->base_url . $uri, $this->headers);
        if(!$data) 
        return false;

        $response =$this->request_client->send($request, [
            'json' => $data
        ]);

        if($response->getStatusCode() != 200){
            return false;
        }
        $response = json_decode($response->getBody(),true);
        return $response;

    }

    public function sendPayment($data){
       $response= $this->buildRequest('/v2/SendPayment','POST',$data);
       return $response;
    }

    public function getPaymentStatus($data){
        $response= $this->buildRequest('/v2/GetPaymentStatus','POST',$data);
        return $response;
    }

   

}