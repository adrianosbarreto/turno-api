<?php

namespace App\Models;

use App\Rules\SufficientBalance;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes; use Illuminate\Database\Eloquent\Factories\HasFactory;
class Transaction extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'transactions';

    public $fillable = [
        'account_id',
        'transactable_id',
        'transactable_type'
    ];

    protected $casts = [
        'account_id' => 'integer',
        'type' => 'string',
        'amount' => 'decimal:2',
        'description' => 'string'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function transactable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
