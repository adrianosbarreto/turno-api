<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public $fillable = [
        'amount',
        'description'
    ];

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'transactable');
    }
}
