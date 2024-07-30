<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'type' => $transaction->transactable_type,
                'amount' => $transaction->transactable->amount ?? null,
                'description' => $transaction->transactable->description ?? null,
                'transaction_id' => $transaction->id,
                'account_id' => $transaction->account_id,
                'created_at' => $transaction->created_at->toIso8601String(),
                'updated_at' => $transaction->updated_at->toIso8601String(),
            ];
        })->all();
    }
}

