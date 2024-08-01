<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes; use Illuminate\Database\Eloquent\Factories\HasFactory;
class Check extends Model
{
     use SoftDeletes;
     use HasFactory;

     public $table = 'checks';

    public $fillable = [
        'income_id',
        'account_id',
        'picture',
        'amount',
        'description',
        'status'
    ];

    protected $casts = [
        'picture' => 'string',
        'amount' => 'decimal:2',
        'description' => 'string',
        'status' => 'string',
        'account_id' => 'integer',
    ];

    public static array $rules = [
        'income_id' => 'nullable|min:1',
        'account_id' => 'required|exists:accounts,id',
        'picture' => 'required|nullable',
        'amount' => 'required|numeric',
        'description' => 'required|min:3|nullable',
        'status' => 'required'
    ];

    public function income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Income::class, 'income_id', 'id');
    }

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

}
