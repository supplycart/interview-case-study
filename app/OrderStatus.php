<?php

namespace App;

enum OrderStatus: int
{
    case PROCESSING = 1;
    case COMPLETED = 2;
}
