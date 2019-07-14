<?php

namespace App;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Remita extends Model
{

    public static function  InitiateMandate($data = array()){
        try{
            $endpoint = "/remita/exapp/api/v1/send/api/echannelsvc/echannel/mandate/setup";
            $amount = $data['amount'] ?: '';
            $payerName = $data['payerName'] ?: '';
            $payerEmail = $data['payerEmail'] ?: '';
            $payerPhone = $data['payerPhone'] ?: '';
            $payerBankCode = $data['payerBankCode'] ?: '';
            $payerAccount = $data['payerAccount'] ?: '';
            $startDate = $data['startDate'] ?: '';
            $endDate = $data['endDate'] ?: '';
            $maxNoOfDebits = $data['maxNoOfDebits'] ?: '';
            $mert =  config('Remita.MERCHANTID');
            $api_key =  config('Remita.APIKEY');
            $serv_id = config('Remita.SERVICETYPEID');
            $mandateType = config('Remita.MANDATETPYE');
            $timesammp=date("dmyHis");
            $requestId = $timesammp;
            $concatString = $mert . $serv_id . $requestId . $amount . $api_key;
            $hash = hash('sha512', $concatString);
            $details = [
                "merchantId" => $mert,
                "serviceTypeId" => $serv_id,
                "hash" => $hash,
                "payerName" => $payerName,
                "payerEmail" => $payerEmail,
                "payerPhone" => $payerPhone,
                "payerBankCode" => $payerBankCode,
                "payerAccount" => $payerAccount,
                "requestId" => $requestId,
                "amount" => $amount,
                "startDate" => $startDate,
                "endDate" => $endDate,
                "mandateType" => $mandateType,
                "maxNoOfDebits" => $maxNoOfDebits
            ];

            return $this->makeRequest($details, $endpoint);

        }
        catch (\Exception $ex){
            $responseObj = new \stdClass();
            $responseObj->statuscode = "022";
            $responseObj->status = "Invalid Request,Please Check Your Parameter";
            $responseObj->requestId = "99999";
            return $responseObj;
        } 
}

            public function makeRequest($data, $url) {
                $client = new Client([
                    // Base URI is used with relative requests
                    'base_uri' => config::get('app.REMITA_APP_URL'),
                    // You can set any number of default request options.
                    'timeout'  => 2.0,
                ]);
                $response = $client->request('POST', $url, [
                    'form_params' => $data
                ]);
                return json_decode($response);
            }

}
