<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image'];

    /**
     * A product can have many sizes.
     */
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    // Связь с заказами
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
