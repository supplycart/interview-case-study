<?php

namespace App\Actions\Models\Order;

use App\Models\Order;
use Illuminate\Support\Str;

class CustomActions
{
    // actions not part of Resource standards are placed here
    public static function generateDocumentNumber($userId)
    {
        $prefix = "SO"; // SO
        $userPrefix = Str::padLeft($userId, 4, '0'); // 0001
        $runningNumber = Order::where('user_id', $userId)->count(); // 3
        $paddedRunningNumber = Str::padLeft($runningNumber, 4, '0'); // 0003

        // SO00010003
        $documentNumber = "{$prefix}{$userPrefix}{$paddedRunningNumber}";

        /**
         * NOTE: reasoning for numbers without symbols e.g.: SO-0001-0003
         * if we were to proceed creating the invoice for this order and we want to maintain the formatting, it will be a problem at e-invoice
         * lets say we have IV-0001-0003, when we submit to e-invoice that'd be no problem
         * the problem is if we want to reverse search by the number (also known as `internalID` in e-invoice);
         * special characters are not allowed.
         *
         * the following results is expected:
         * - IV-0001-0003 : not found
         * - IV00010003 : found
         *
         * * https://sdk.myinvois.hasil.gov.my/einvoicingapi/09-search-documents/ : #Inputs @ searchQuery
         */

        return $documentNumber;
    }
}
