<?php

namespace App\Http\Services;

use SoapClient;
use Exception;

class CegidCustomService
{
    private $soapClient;
    public function __construct()
    {
        $url = env('CEGID_SERVER_IP') . "CustomerWcfService.svc";

        $this->soapClient = new SoapClient(
            $url . "?singleWsdl",
            array(
                "location" => $url,
                "login" => env('CEGID_SERVER_USSER'),
                "password" => env('CEGID_SERVER_PASSWORD')
            )
        );
    }

    public function createCustom($request)
    {
        try {
            $resu = $this->soapClient->AddNewCustomer($request);
            return $resu;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function updateCustomer($request)
    {
        try {
            $resu = $this->soapClient->UpdateCustomer($request);
            return $resu;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function getCustomFromCegid($request)
    {
        try {
            $resu = $this->soapClient->GetCustomerDetail($request);
            return $resu;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}