<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public function index(){
        $Username =  'linc-test';
        $Password =  '123456';
        $API_KEY =  'ojh545we4t5254sdgfsaefstg65478';
        $Signature_Key=  '879sdg78dsfg56sd4g7987eswg76';
        $Body =  '{email:ariefmanggalaputra25@gmail.com}';
        $Method =  'POST';
        $Endpoint =  "https:/integrasi.delapancommerce.com";
        $URL_Request =  "/v1/test-new-employee";

        $date = date('Y-m-d H:i:s.v');



        $key_api = "POST\n3f0661c19be8c12a8f8df28a3b39089f\napplication/json\n".$date."\n/v1/test-new-employee";
        echo $key_api;
        $s = hash_hmac('sha256', $key_api, $Signature_Key, false);



        $client = new \GuzzleHttp\Client([
            'headers'   => [
                'Accept'=>'application/json',
                'Content-type' => 'application/json', 
                'API-KEY' => $API_KEY, 
                'Signature' => $s,
                'Signature-Time' => $date,
            ],
            'auth' => [$Username, $Password],
            'http_errors' => false
        ]);

        $response = $client->post($Endpoint.$URL_Request,
            ['body' => json_encode(
                [
                    "email"=>"manggala.corp@gmail.com"
                ]
            )]
        );  

        dd($response->getBody()->getContents());
        $resp = json_decode($response->getBody()->getContents());
        return $resp;




    }
}
