<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartProducts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["user_id", "product_id", "quantity", "shopping_cart_id"];

    /**
     * Define a relationship: a shopping cart product belongs to a product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        // Establishing a "belongs to" relationship with the Product model.
        return $this->belongsTo(Product::class);
    }

    /**
     * Define a relationship: a shopping cart product belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Establishing a "belongs to" relationship with the User model.
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship: a shopping cart product belongs to a shopping cart.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shoppingCart()
    {
        // Establishing a "belongs to" relationship with the ShoppingCart model.
        return $this->belongsTo(ShoppingCart::class);
    }
}
