<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['email', 'phone', 'address', 'totalPrice', 'comment'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('size', 'quantity', 'price')
            ->withTimestamps();
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
