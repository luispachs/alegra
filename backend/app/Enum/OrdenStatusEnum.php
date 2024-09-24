<?php

namespace App\Enum;

enum OrdenStatusEnum :string{

    case IN_PROCESS = "IN PROCESS";
    case REQUESTED = "REQUESTED";
    case DELIVERED = "DELIVERED";


    public static function getFromValue(string $key):OrdenStatusEnum{
        return match($key){
            'IN PROCESS' => OrdenStatusEnum::IN_PROCESS,
            'REQUESTED' => OrdenStatusEnum::REQUESTED,
            'DELIVERED' => OrdenStatusEnum::DELIVERED,
            default => null
        };
    }
}