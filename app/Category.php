<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'product_id', 'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'categories_id','id');   
    }
}
