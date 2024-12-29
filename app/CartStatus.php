<?php

namespace App;


enum CartStatus: int
{
    case PENDING_CHECKOUT = 1;
    case CHECKOUT_COMPLETED = 2;
}
