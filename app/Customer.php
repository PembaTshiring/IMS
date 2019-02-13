<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;

    protected $fillable=[
        'customer_name',
        'contact',
        'total_purchase',
        'total_paid',
        'total_due',
    ];

    protected $dates=['deleted_at'];
}
