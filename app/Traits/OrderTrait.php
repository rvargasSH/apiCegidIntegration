<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use StdClass;
use Carbon\Carbon;

trait OrderTrait
{

    /**
     * create the object whit the xml format.
     *
     * @param mixed $input
     */
    public function renderOrderBody($input)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        $request = new StdClass();
        $request->createRequest = new StdClass();
        $request->createRequest->DeliveryAddress = new StdClass();
        $request->createRequest->DeliveryAddress->City = $input['order']['customer']['default_address']['city'];
        $request->createRequest->DeliveryAddress->ContactNumber = '0';
        $request->createRequest->DeliveryAddress->CountryIdType = 'Internal';
        $request->createRequest->DeliveryAddress->FirstName =  $input['order']['customer']['first_name'];
        $request->createRequest->DeliveryAddress->LastName = $input['order']['customer']['last_name'];
        $request->createRequest->DeliveryAddress->Line1 =  $input['order']['customer']['default_address']['address1'];
        $request->createRequest->DeliveryAddress->PhoneNumber = $input['order']['customer']['default_address']['phone'];
        if (isset($input['region'])) {
            $request->createRequest->DeliveryAddress->Region = $input['region']['regRegionCode'];
            $request->createRequest->DeliveryAddress->ZipCode = $input['region']['regPostalCodeCegid'];
            $request->createRequest->DeliveryAddress->CountryId = $input['region']['regCountryCode'];
        }
        $request->createRequest->Header = new StdClass();
        $request->createRequest->Header->Active = 'true';
        $request->createRequest->Header->CurrencyId = $input['order']['line_items'][0]['price_set']['shop_money']['currency_code'];
        $request->createRequest->Header->CustomerId = $input['customerId'];
        $request->createRequest->Header->Date = Carbon::now()->format('Y-m-d');
        $request->createRequest->Header->ExternalReferenceDate = Carbon::now()->format('Y-m-d');
        $request->createRequest->Header->InternalReference = $input['order']['id'];

        $request->createRequest->Header->LinesUnmodifiable = false;
        $request->createRequest->Header->OmniChannel = new StdClass();
        $request->createRequest->Header->OmniChannel->BillingStatus = 'Pending';
        $request->createRequest->Header->OmniChannel->CancelDate = '1900-01-01';
        $request->createRequest->Header->OmniChannel->DeliveryStoreId = $input['location']['locCegidId'];
        $request->createRequest->Header->OmniChannel->DeliveryType = 'BookedInStore';
        $request->createRequest->Header->OmniChannel->FollowUpStatus = 'BookedInStore';
        $request->createRequest->Header->OmniChannel->GiftMessageType = 'None';
        $request->createRequest->Header->OmniChannel->LockingDate = Carbon::now()->format('Y-m-d');
        $request->createRequest->Header->OmniChannel->PaymentStatus = 'Totally';
        $request->createRequest->Header->OmniChannel->ReturnStatus = 'Returned';
        $request->createRequest->Header->OmniChannel->ReturnType = 'Exchange';
        $request->createRequest->Header->OmniChannel->ShippingStatus = 'Pending';
        $request->createRequest->Header->Origin = 'ECommerce';
        $request->createRequest->Header->StoreId = '1999';
        $request->createRequest->Header->TaxExcluded = false;
        $request->createRequest->Header->Type = 'CustomerOrder';
        $request->createRequest->InvoicingAddress = new StdClass();
        $request->createRequest->InvoicingAddress->City = $input['order']['customer']['default_address']['city'];
        $request->createRequest->InvoicingAddress->ContactNumber = '0';
        if (isset($input['region'])) {
            $request->createRequest->InvoicingAddress->CountryId = $input['region']['regCountryCode'];
        }
        $request->createRequest->InvoicingAddress->CountryIdType = 'Internal';
        $request->createRequest->InvoicingAddress->FirstName = $input['order']['customer']['first_name'];
        $request->createRequest->InvoicingAddress->LastName = $input['order']['customer']['last_name'];
        $request->createRequest->InvoicingAddress->Line1 = $input['order']['customer']['default_address']['address1'];
        $request->createRequest->InvoicingAddress->PhoneNumber = $input['order']['customer']['default_address']['phone'];
        if (isset($input['region'])) {
            $request->createRequest->InvoicingAddress->ZipCode = $input['region']['regPostalCodeCegid'];
        }

        $request->createRequest->Lines = array();
        $i = 0;
        foreach ($input['order']['line_items'] as $key => $item) {
            $Create_Line = new StdClass();
            $Create_Line->ComplementaryDescription =  $item['name'];
            $Create_Line->DeliveryDate = Carbon::now()->format('Y-m-d');
            $Create_Line->DiscountTypeId = 'ONL';
            $Create_Line->CancelStatus = 'Unlocked';
            $Create_Line->ItemIdentifier = new StdClass();
            $Create_Line->ItemIdentifier->Reference = $item['vendor'];
            $Create_Line->Label = $item['name'];
            $Create_Line->NetUnitPrice = $item['price_set']['shop_money']['amount'];
            $Create_Line->Origin = 'ECommerce';
            $Create_Line->Quantity = $item['quantity'];
            $Create_Line->UnitPrice = $item['price'];
            $request->createRequest->Lines[] = $Create_Line;
            $i++;
        }
        //End for

        $request->createRequest->Payments = new StdClass();
        $request->createRequest->Payments->Create_Payment = new StdClass();
        $request->createRequest->Payments->Create_Payment->Amount = $input['order']['current_total_price'];
        $request->createRequest->Payments->Create_Payment->CurrencyId = 'CRC';
        $request->createRequest->Payments->Create_Payment->DueDate = Carbon::now()->format('Y-m-d');
        $request->createRequest->Payments->Create_Payment->Id = '1';
        $request->createRequest->Payments->Create_Payment->IsReceivedPayment = false;
        $request->createRequest->Payments->Create_Payment->MethodId = $input['order']['payMethod'];


        $request->clientContext = new StdClass();
        $request->clientContext->DatabaseId = env('CEGID_DATA_BASE');

        return $request;
    }
    /**
     * create the object whit the xml format.
     *
     * @param mixed $input
     */
    public function renderGetOrderBody($idOrder)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        $request = new StdClass();
        $request->searchRequest = new StdClass();
        $request->searchRequest->Key = new StdClass();
        $request->searchRequest->Key->Number = $idOrder;
        $request->searchRequest->Key->Stump = 1999;
        $request->searchRequest->Key->Type = 'CustomerOrder';
        $request->clientContext = new StdClass();
        $request->clientContext->DatabaseId = env('CEGID_DATA_BASE');

        return $request;
    }
}