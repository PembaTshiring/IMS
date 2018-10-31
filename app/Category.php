<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $fillable=[
        'category_name',
        'category_status'
    ]; 
    
    protected $dates=['deleted_at'];

    public function getCategoryNameAttribute($category_name){
        return ucwords($category_name);
    }
}
