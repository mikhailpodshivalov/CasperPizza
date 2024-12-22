<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['email', 'phone', 'address', 'total_price'];

    // Связь с продуктами в заказе
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('size', 'quantity', 'price')
            ->withTimestamps();
    }
}
