<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistoryModel extends Model
{
    use HasFactory;

    protected $table ="purchase_History";
    public $timestamps = false;
}
