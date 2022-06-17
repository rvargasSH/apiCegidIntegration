<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use StdClass;

trait SellResponseTrait
{

    public function setSellsBodyResponse($serviceResponse)
    {
        $response = new StdClass();
        if (isset($serviceResponse->GetHeaderListResult->Headers->Get_Header)) {
            $response->status = 200;
            $response->message = "Order found";
            $response->response = $this->getTotalSellsByStore($serviceResponse->GetHeaderListResult->Headers->Get_Header);
        } else {
            $response->status = 500;
            $response->message = "Not sells to this store";
            $response->entityId = "";
        }

        return $response;
    }

    private function getTotalSellsByStore($sells)
    {
        $totalWhitTax = $totalWhitOutTax = $toltalQuantity = 0;
        $counter = 0;
        foreach ($sells as $key => $sell) {
            $totalWhitTax += $sell->TaxIncludedTotalAmount;
            $totalWhitOutTax += $sell->TaxExcludedTotalAmount;
            $toltalQuantity += $sell->TotalQuantity;
            $counter++;
        }
        $response = new StdClass();
        $response->totalWhitTax = $totalWhitTax;
        $response->totalWhitOutTax = $totalWhitOutTax;
        $response->toltalQuantity = $toltalQuantity;
        $response->toltalTransaction = $counter;
        return $response;
    }
}