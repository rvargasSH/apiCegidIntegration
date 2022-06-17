<?php

namespace App\Http\Controllers;

use App\Http\Services\CegidOrderService;
use App\Traits\OrderTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log as FacadesLog;

class OrderController extends Controller
{
    use OrderTrait;
    use ResponseTrait;
    private $cegidSoapService;
    public function __construct(CegidOrderService $cegidSoapService)
    {
        $this->cegidSoapService = $cegidSoapService;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(Request $request)
    {

        $input        = $request->all();
        try {
            $request = $this->renderOrderBody($input);
            $serviceReponse = $this->cegidSoapService->createOrder($request);
            //FacadesLog::info("RESPONSEOK:\n" .  $serviceReponse . "\n");
            return response()->json($this->setOrderResponseBody($serviceReponse), 200);
        } catch (Exception $e) {
            FacadesLog::error("RESPONSEERROR:\n" .  $e . "\n");
            return response()->json($e, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderStatus($orderId)
    {
        $request = $this->renderGetOrderBody($orderId);
        $serviceReponse = $this->cegidSoapService->getOrderByKey($request);
        return response()->json($this->setOrderStatusBody($serviceReponse), 200);
    }
}