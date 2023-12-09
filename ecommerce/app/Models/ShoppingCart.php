<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["user_id"];

    /**
     * Define a relationship: a shopping cart belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Establishing a "belongs to" relationship with the User model.
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship: a shopping cart has many products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shoppingCartProducts()
    {
        // Establishing a "has many" relationship with the ShoppingCartProducts model.
        return $this->hasMany(ShoppingCartProducts::class);
    }
}
