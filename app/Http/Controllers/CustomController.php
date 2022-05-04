<?php

namespace App\Http\Controllers;

use App\Http\Services\CegidCustomService;
use App\Traits\CustomTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use SoapClient;
use StdClass;
use Exception;
use Illuminate\Routing\Route;

class CustomController extends Controller
{

    use CustomTrait;
    use ResponseTrait;
    private $cegidSoapService;
    public function __construct(CegidCustomService $cegidSoapService)
    {
        $this->cegidSoapService = $cegidSoapService;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCustomer(Request $request)
    {

        $input        = $request->all();
        $request = $this->renderUserBody($input);
        $serviceReponse = $this->cegidSoapService->createCustom($request);

        return response()->json($this->setCustomResponseBody($serviceReponse), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCustomer(Request $request)
    {
        $input        = $request->all();
        $request = $this->renderUserBodyToUpdated($input);
        $serviceReponse = $this->cegidSoapService->updateCustomer($request);
        return response()->json($this->setCustomResponseBody($serviceReponse), 200);
    }
}