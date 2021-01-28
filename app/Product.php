<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'categories_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class,'categories_id','id');
    }

    public function transactions() 
    {
        return $this->hasMany(Transaction::class,'products_id','id');   

    }

}
