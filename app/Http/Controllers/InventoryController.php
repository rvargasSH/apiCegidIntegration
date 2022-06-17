<?php

namespace App\Http\Controllers;

use App\Http\Services\CegidInventoryService;
use App\Http\Services\CegidOrderService;
use App\Traits\GetInformationTrait;
use App\Traits\InventoryResponseTrait;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    use GetInformationTrait;
    use InventoryResponseTrait;
    private $cegidSoapService;
    public function __construct(CegidInventoryService $cegidSoapService)
    {
        $this->cegidSoapService = $cegidSoapService;
    }

    /**
     * Return the sells to a store from the day before
     *
     * @return \Illuminate\Http\Response
     */
    public function getInventoryByStoreAndProductCode($storeId, $productCode)
    {
        $request = $this->renderGetInventoryQueryByStoreAndProduct($storeId, $productCode);
        $serviceReponse = $this->cegidSoapService->getAvailableQty($request);
        return response()->json($this->setInventoryBodyResponse($serviceReponse), 200);
    }
}