<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;
    
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
    protected $dates=['deleted_at'];

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
    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_item', 'order_id', 'product_id');
    }

    public function getProductNameAttribute($product_name){
        return ucwords($product_name);
    }

}
