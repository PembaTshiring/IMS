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
        return $this->hasOne('App\Category','category_id','category_id');
    }

    public function brands()
    {
        return $this->hasOne('App\Brand', 'brand_id', 'brand_id');
    }

}
