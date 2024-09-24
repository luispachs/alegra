<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\{Artisan,Schedule};
use App\Jobs\ProcessOrden;
use App\Jobs\ProcessPurchase;

Schedule::call(function(){
    $taks = new ProcessOrden();
    $taks->handle();
})->everyFiveSeconds();

Schedule::call(function(){
    $task = new ProcessPurchase();
    $task->handle();
})->everyFiveSeconds();

