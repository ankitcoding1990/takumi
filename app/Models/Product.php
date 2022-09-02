<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nette\Utils\Json;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku','name','category_id','price','discount','status'
    ];

    protected $casts = [
        'price' => 'integer',
        'discount' => 'integer',
    ];

    function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    function getFinalAttribute(){
        $price = $this->attributes['price'];
        $discount = $this->attributes['discount'];
        if($discount != null && !empty($discount)){
            return $price - (($price * $discount) / 100);
        }
        return $price;
    }
    function getDiscountPercentageAttribute(){
        $discount = $this->attributes['discount'];
        if (!empty($discount) && $discount != null) {
            return $discount . '%';
        }
        return null;
    }
}
