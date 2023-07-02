<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductGallery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'photos', 'products_id'
    ];

    protected $hidden = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'products_id', 'id');
    // }
}
