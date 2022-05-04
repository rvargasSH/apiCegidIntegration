<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use StdClass;

trait ResponseTrait
{
    public function setCustomResponseBody($serviceResponse)
    {
        $response = new StdClass();
        if (isset($serviceResponse->AddNewCustomerResult)) {
            $response->status = 200;
            $response->message = "User created";
            $response->entityId = $serviceResponse->AddNewCustomerResult;
        } elseif (isset($serviceResponse->UpdateCustomerResult)) {
            $response->status = 200;
            $response->message = "User updated";
            $response->entityId = $serviceResponse->UpdateCustomerResult;
        } else {
            $response->status = 500;
            $response->message = "Error" . $serviceResponse->original;
            $response->entityId = "";
        }

        return $response;
    }

    public function setOrderResponseBody($serviceResponse)
    {
        $response = new StdClass();
        if (isset($serviceResponse->CreateResult)) {
            $response->status = 200;
            $response->message = "Order created";
            $response->entityId = $serviceResponse->CreateResult->Key->Number;
        } else {
            $response->status = 500;
            $response->message = "Error" . $serviceResponse->original->detail->CbpExceptionDetail->InnerException->enc_value->InnerException->InnerException->Message;
            $response->entityId = "";
        }

        return $response;
    }

    public function setOrderStatusBody($serviceResponse)
    {
        $response = new StdClass();
        if (isset($serviceResponse->GetByKeyResult)) {
            $response->status = 200;
            $response->message = "Order found";
            $response->entityId = $serviceResponse->GetByKeyResult->Header->OmniChannel->FollowUpStatus;
        } else {
            $response->status = 500;
            $response->message = "Error" . $serviceResponse->original->faultstring;
            $response->entityId = "";
        }

        return $response;
    }
}