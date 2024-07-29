<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class Account extends Model
{
     use SoftDeletes;
     use HasFactory;

     public $table = 'accounts';

    public $fillable = [
        'user_id',
        'type',
        'account_number',
        'current_balance',
        'user_name'
    ];

    protected $casts = [
        'type' => 'string',
        'account_number_number' => 'string',
        'current_balance' => 'decimal:2',
        'user_name' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required|min:1',
        'type' => 'required',
        'account_number_number' => 'required',
        'current_balance' => 'required|numeric',
        'user_name' => 'required'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
