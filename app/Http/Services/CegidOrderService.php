<?php

namespace App\Http\Services;

use SoapClient;
use Exception;
use Illuminate\Support\Facades\Log as FacadesLog;

class CegidOrderService
{
    private $soapClient;
    public function __construct()
    {
        $url = env('CEGID_SERVER_IP') . "SaleDocumentService.svc";

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

    public function createOrder($request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        try {
            $resu = $this->soapClient->Create($request);
            FacadesLog::info("REQUEST:\n" . htmlentities($this->soapClient->__getLastRequest()) . "\n");
            return $resu;
        } catch (Exception $e) {
            FacadesLog::error("ERROR:\n" . htmlentities($this->soapClient->__getLastRequest()) . "\n");
            return response()->json($e, 500);
        }
    }

    public function getOrderByKey($request)
    {
        try {
            $resu = $this->soapClient->GetByKey($request);
            return $resu;
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
}