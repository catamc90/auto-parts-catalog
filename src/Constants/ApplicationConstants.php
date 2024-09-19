<?php

namespace App\Constants;

class ApplicationConstants
{
    public const TYPE_AUTOMOBILE = 1;
    public const TYPE_COMMERCIALVEHICLES = 2;
    public const TYPE_MOTO = 3;

    public const VEHICLE_TYPES_MATRIX = [
        self::TYPE_AUTOMOBILE => 'Automobile',
        self::TYPE_COMMERCIALVEHICLES => 'Commercial-Vehicles',
        self::TYPE_MOTO => 'Moto',
    ];
}
