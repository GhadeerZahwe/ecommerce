<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["user_id", "product_id", "quantity", "total_price"];

    /**
     * Define a relationship: a transaction belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Establishing a "belongs to" relationship with the User model.
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship: a transaction belongs to a product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        // Establishing a "belongs to" relationship with the Product model, specifying the foreign key.
        return $this->belongsTo(Product::class, 'product_id');
    }
}
