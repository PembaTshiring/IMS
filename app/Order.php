<?php

namespace App;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'order_id',
        'order_date',
        'client_name',
        'client_contact',
        'sub_total',
        'vat',
        'total_amount',
        'discount',
        'grand_total',
        'paid',
        'due',
        'payment_type',
        'payment_status',
        'order_status',
    ];
    public function products()
    {
        return $this->hasMany('App\Product', 'product_id', 'product_id');
    }
    
}
