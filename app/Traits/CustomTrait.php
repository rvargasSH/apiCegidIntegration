<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use StdClass;

trait CustomTrait
{

    /**
     * create the object whit the xml format.
     *
     * @param mixed $input
     */
    public function renderUserBody($input)
    {
        $request = new StdClass();
        $request->customerData = new StdClass();
        $request->customerData->AddressData = new StdClass();
        $request->customerData->AddressData->AddressLine1 = $input['order']['customer']['default_address']['address1'];
        $request->customerData->AddressData->AddressLine2 = $input['order']['customer']['default_address']['address2'];
        $request->customerData->AddressData->City =  $input['order']['customer']['default_address']['city'];
        $request->customerData->AddressData->CountryIdType = "Internal";
        $request->customerData->AddressData->Nata = false;
        if (isset($input['region'])) {
            $request->customerData->AddressData->CountryId = $input['region']['regCountryCode'];
            $request->customerData->AddressData->RegionId = $input['region']['regRegionCode'];
            $request->customerData->AddressData->ZipCode = $input['region']['regPostalCodeCegid'];
        }
        $request->customerData->AlternateLastName = "CC";
        $request->customerData->EmailData = new StdClass();
        $request->customerData->EmailData->Email =  $input['order']['customer']['email'];
        $request->customerData->EmailData->EmailingAccepted = false;
        $request->customerData->EmailData->SendReceiptByMail = false;
        $request->customerData->FirstName = $input['order']['customer']['first_name'];
        $request->customerData->IsCompany = false;
        $request->customerData->LastName = $input['order']['customer']['last_name'];
        $request->customerData->IsCompany = false;
        $request->customerData->PhoneData = new StdClass();
        $request->customerData->PhoneData->CellularPhoneNumber = $input['order']['customer']['default_address']['phone'];
        $request->customerData->UsualStoreId = $input['location']['locCegidId'];
        $request->customerData->BirthDateData = new StdClass();
        $request->customerData->BirthDateData->BirthDateDay = 1;
        $request->customerData->BirthDateData->BirthDateMonth = 1;
        $request->customerData->BirthDateData->BirthDateYear = 1900;
        $request->customerData->CurrencyId = $input['order']['line_items'][0]['price_set']['shop_money']['currency_code'];
        $request->customerData->LanguageId = "ESP";
        $request->customerData->LongDescription = $input['order']['customer']['first_name'] . $input['order']['customer']['last_name'];
        if (isset($input['region'])) {
            $request->customerData->NationalityId = $input['region']['regCountryCode'];
        }
        $request->customerData->OptinAlternativeEmail = "DoNotUse";
        $request->customerData->OptinEmail = "AskCustomer";
        $request->customerData->OptinMobile = "AskCustomer";
        $request->customerData->OptinOfficePhone = "AskCustomer";
        $request->customerData->PassportNumber = "12;" . $input['order']['customer']['default_address']['company'];
        $request->customerData->ShortName = $input['order']['customer']['first_name'];
        $request->customerData->ValidAlternativeEmail = false;
        $request->customerData->ValidEmail = true;
        $request->customerData->ValidMobile = true;
        $request->customerData->ValidOfficePhone = false;
        $request->clientContext = new StdClass();
        $request->clientContext->DatabaseId = env('CEGID_DATA_BASE');

        return $request;
    }

    /**
     * create the object whit the xml format.
     *
     * @param mixed $input
     */
    public function renderUserBodyToUpdated($input)
    {
        $request = new StdClass();
        $request->customerId = $input['customerId'];
        $request->modifiedData = new StdClass();
        $request->modifiedData->AddressData = new StdClass();
        $request->modifiedData->AddressData->AddressLine1 = $input['order']['customer']['default_address']['address1'];
        $request->modifiedData->AddressData->AddressLine2 = $input['order']['customer']['default_address']['address2'];
        $request->modifiedData->AddressData->City =  $input['order']['customer']['default_address']['city'];
        $request->modifiedData->AddressData->CountryIdType = "Internal";
        $request->modifiedData->AddressData->Nata = false;
        if (isset($input['region'])) {
            $request->modifiedData->AddressData->CountryId = $input['region']['regCountryCode'];
            $request->modifiedData->AddressData->RegionId = $input['region']['regRegionCode'];
            $request->modifiedData->AddressData->ZipCode = $input['region']['regPostalCodeCegid'];
        }
        $request->modifiedData->AlternateLastName = "CC";
        $request->modifiedData->EmailData = new StdClass();
        $request->modifiedData->EmailData->Email =  $input['order']['customer']['email'];
        $request->modifiedData->EmailData->EmailingAccepted = false;
        $request->modifiedData->EmailData->SendReceiptByMail = false;
        $request->modifiedData->FirstName = $input['order']['customer']['first_name'];
        $request->modifiedData->LastName = $input['order']['customer']['last_name'];
        $request->modifiedData->PhoneData = new StdClass();
        $request->modifiedData->PhoneData->CellularPhoneNumber = $input['order']['customer']['default_address']['phone'];
        $request->modifiedData->UsualStoreId = $input['location']['locCegidId'];
        $request->modifiedData->BirthDateData = new StdClass();
        $request->modifiedData->BirthDateData->BirthDateDay = 1;
        $request->modifiedData->BirthDateData->BirthDateMonth = 1;
        $request->modifiedData->BirthDateData->BirthDateYear = 1900;
        $request->modifiedData->CurrencyId = $input['order']['line_items'][0]['price_set']['shop_money']['currency_code'];
        $request->modifiedData->LanguageId = "ESP";
        $request->modifiedData->LongDescription = $input['order']['customer']['first_name'] . $input['order']['customer']['last_name'];
        if (isset($input['region'])) {
            $request->modifiedData->NationalityId = $input['region']['regCountryCode'];
        }
        $request->modifiedData->OptinAlternativeEmail = "DoNotUse";
        $request->modifiedData->OptinEmail = "AskCustomer";
        $request->modifiedData->OptinMobile = "AskCustomer";
        $request->modifiedData->OptinOfficePhone = "AskCustomer";
        $request->modifiedData->PassportNumber = "12;" . $input['order']['customer']['default_address']['company'];
        $request->modifiedData->ShortName = $input['order']['customer']['first_name'];
        $request->modifiedData->ValidAlternativeEmail = false;
        $request->modifiedData->ValidEmail = true;
        $request->modifiedData->ValidMobile = true;
        $request->modifiedData->ValidOfficePhone = false;
        $request->clientContext = new StdClass();
        $request->clientContext->DatabaseId = env('CEGID_DATA_BASE');

        return $request;
    }
}