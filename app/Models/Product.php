<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'categories_id',
        'size',
        'weight',
        'price',
        'description',
        'slug'
    ];

    protected $hidden = [];

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'products_id', 'id');
    }

    public function productGalleries(): HasMany
    {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // public function galleries()
    // {
    //     return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    // }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'categories_id', 'id');
    // }

}