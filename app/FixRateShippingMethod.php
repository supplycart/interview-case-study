<?php

namespace App;


class FixRateShippingMethod extends ShippingMethod
{


    static function getRate()
    {
        return 15;
    }

    static function getLabel()
    {
        return 'Ship Now';
    }

    static function getDeliveryTime ()
    {
        return '5-7 days';
    }
}
