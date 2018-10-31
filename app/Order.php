<?php

namespace App;
use App\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;

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
    protected $dates=['deleted_at'];

    public function products()
    {
        return $this->hasMany('App\Product', 'product_id', 'product_id');
    }
    public function getClientNameAttribute($client_name){
        return ucwords($client_name);
    }
}
