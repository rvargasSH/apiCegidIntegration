<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use StdClass;
use Carbon\Carbon;

trait GetInformationTrait
{

    /**
     * create the object whit the xml format.
     *
     * @param mixed $input
     */
    public function renderGetSellsQueryByStore($storeId)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        $request = new StdClass();
        $request->searchRequest = new StdClass();
        // $request->searchRequest->EndDate = Carbon::yesterday()->format('Y-m-d');
        // $request->searchRequest->BeginDate = Carbon::yesterday()->format('Y-m-d');
        $request->searchRequest->BeginDate = '2022-05-18';
        $request->searchRequest->EndDate = '2022-05-18';
        $request->searchRequest->StoreIds = new StdClass();
        $request->searchRequest->StoreIds->string = $storeId;
        $request->clientContext = new StdClass();
        $request->clientContext->DatabaseId = env('CEGID_DATA_BASE');

        return $request;
    }

    /**
     * create the object whit the xml format.
     *
     * @param mixed $input
     */
    public function renderGetInventoryQueryByStoreAndProduct($storeId, $productCode)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        $request = new StdClass();
        $request->itemIdentifier = new StdClass();
        $request->itemIdentifier->Reference = $productCode;
        $request->storeId = $storeId;
        $request->clientContext = new StdClass();
        $request->clientContext->DatabaseId = env('CEGID_DATA_BASE');

        return $request;
    }
}