<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{

    use SoftDeletes;

    protected $fillable=[
        'brand_name',
        'brand_status'
    ]; 
    
    protected $dates=['deleted_at'];

    public function getBrandNameAttribute($brand_name){
        return ucwords($brand_name);
    }

}
