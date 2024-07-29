<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes; use Illuminate\Database\Eloquent\Factories\HasFactory;
class Transaction extends Model
{
     use SoftDeletes;    use HasFactory;    public $table = 'transactions';

    public $fillable = [
        'user_id',
        'type',
        'amount',
        'date',
        'description'
    ];

    protected $casts = [
        'type' => 'string',
        'amount' => 'decimal:2',
        'date' => 'date',
        'description' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required|min:1',
        'type' => 'required',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'description' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
