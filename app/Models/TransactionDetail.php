<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected $fillable = [
        'transactions_id',
        'products_id',
        'size',
        'price',
        'resi',
        'code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(TransactionDetail::class, 'transactions_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    // public function product() {
    //     return $this->hasOne(Product::class, 'id', 'products_id');
    // }

    // public function transaction() {
    //     return $this->hasMany(Transaction::class, 'users_id', 'transactions_id');
    // }
}
