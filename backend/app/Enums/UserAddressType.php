<?php

namespace App\Enums;

enum UserAddressType: string
{
    case SHIPPING = 'shipping';
    case BILLING = 'billing';
}
