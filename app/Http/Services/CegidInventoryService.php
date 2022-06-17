<?php

namespace App\Http\Services;

use SoapClient;
use Exception;
use Illuminate\Support\Facades\Log as FacadesLog;

class CegidInventoryService
{
    private $soapClient;
    public function __construct()
    {
        $url = env('CEGID_SERVER_IP') . "ItemInventoryWcfService.svc";

        $this->soapClient = new SoapClient(
            $url . "?singleWsdl",
            array(
                'trace' => true,
                "location" => $url,
                "login" => env('CEGID_SERVER_USSER'),
                "password" => env('CEGID_SERVER_PASSWORD')
            )
        );
    }


    public function getAvailableQty($request)
    {
        try {
            $resu = $this->soapClient->GetAvailableQty($request);
            FacadesLog::info("REQUEST:\n" . htmlentities($this->soapClient->__getLastRequest()) . "\n");
            return $resu;
        } catch (Exception $e) {
            FacadesLog::error("ERROR:\n" . htmlentities($this->soapClient->__getLastRequest()) . "\n");
            return response()->json($e, 500);
        }
    }
}