<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use StdClass;

trait InventoryResponseTrait
{

    public function setInventoryBodyResponse($serviceResponse)
    {
        $response = new StdClass();
        if (isset($serviceResponse->GetAvailableQtyResult)) {
            $response->status = 200;
            $response->message = "Inventory found";
            $custoResponse = new StdClass();
            $custoResponse->totalAvaliable = $serviceResponse->GetAvailableQtyResult->AvailableQty;
            $response->response = $custoResponse;
        } else {
            $response->status = 500;
            $response->message = "Not not Inventory Found";
            $custoResponse = new StdClass();
            $response->response = $custoResponse;
        }

        return $response;
    }
}