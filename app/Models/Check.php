<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes; use Illuminate\Database\Eloquent\Factories\HasFactory;
class Check extends Model
{
     use SoftDeletes;    use HasFactory;    public $table = 'checks';

    public $fillable = [
        'transaction_id',
        'picture',
        'amount',
        'description',
        'status'
    ];

    protected $casts = [
        'picture' => 'string',
        'amount' => 'decimal:2',
        'description' => 'string',
        'status' => 'string'
    ];

    public static array $rules = [
        'transaction_id' => 'required|min:1',
        'picture' => 'nullable',
        'amount' => 'required|numeric',
        'description' => 'nullable',
        'status' => 'required'
    ];

    public function transaction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Transaction::class, 'transaction_id', 'id');
    }
}
