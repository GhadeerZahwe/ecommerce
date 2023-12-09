<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["product_name", "product_description", "product_price", "stock_quantity", "user_id"];

    /**
     * Define a relationship: a product belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // The user_id column on the products table is used as the foreign key.
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define a relationship: a product has many transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        // The second parameter specifies the foreign key (product_id) on the transactions table.
        return $this->hasMany(Transaction::class, 'product_id');
    }
}
