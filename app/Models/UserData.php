<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes; use Illuminate\Database\Eloquent\Factories\HasFactory;
class UserData extends Model
{
     use SoftDeletes;
     use HasFactory;

     public $table = 'user_datas';

    public $fillable = [
        'user_id',
        'type',
        'account',
        'current_balance',
        'user_name'
    ];

    protected $casts = [
        'type' => 'string',
        'account' => 'string',
        'current_balance' => 'decimal:2',
        'user_name' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required|min:1',
        'type' => 'required',
        'account' => 'required',
        'current_balance' => 'required|numeric',
        'user_name' => 'required'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
