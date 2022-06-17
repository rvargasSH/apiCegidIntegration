<?php

namespace App\Http\Controllers;

use App\Http\Services\CegidOrderService;
use App\Traits\GetInformationTrait;
use App\Traits\ResponseTrait;
use App\Traits\SellResponseTrait;
use Illuminate\Http\Request;

class SellsController extends Controller
{
    use GetInformationTrait;
    use SellResponseTrait;
    private $cegidSoapService;
    public function __construct(CegidOrderService $cegidSoapService)
    {
        $this->cegidSoapService = $cegidSoapService;
    }

    /**
     * Return the sells to a store from the day before
     *
     * @return \Illuminate\Http\Response
     */
    public function getSellsByStore($storeId)
    {
        $request = $this->renderGetSellsQueryByStore($storeId);
        $serviceReponse = $this->cegidSoapService->getSellsByStore($request);
        return response()->json($this->setSellsBodyResponse($serviceReponse), 200);
    }
}