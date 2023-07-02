<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'users_id',
        'insurance_price',
        'shipping_price',
        'total_price',
        'transaction_status',
        'shipping_status',
        'code',
        'courier',
        'service'
    ];

    protected $hidden = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // public function user(){
    //     return $this->belongsTo(User::class, 'users_id', 'id');
    // }

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }


    // public function transaction_details()
    // {
    //     return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    // }
}

