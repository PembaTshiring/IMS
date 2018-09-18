<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'product_code',
        'product_name',
        'product_quantity',
        'product_rate',
        'brand_id',
        'category_id',
        'product_image',
        'product_status',

    ]; 

    public function users()
    {
        return $this->belongsTo('App\User');
    }
    
    public function categories()
    {
        return $this->belongsTo('App\Category');
    }

    public function brands()
    {
        return $this->belongsTo('App\Brand');
    }

}
