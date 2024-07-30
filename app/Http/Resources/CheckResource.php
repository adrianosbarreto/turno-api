<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CheckResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $grouped = $this->groupByStatus($this->collection);

        return $grouped;
    }

    /**
     * Agrupa os dados por mês e status.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $resource
     * @return array
     */
    protected function groupByStatus($resource) : array
    {
        $grouped = [
            'pending' => [],
            'accept' => [],
            'reject' => [],
        ];

        foreach ($resource as $item) {
            $status = $item->status;

            if (isset($grouped[$status])) {
                $grouped[$status][] = [
                    'id' => $item->id,
                    'transaction_id' => $item->transaction_id,
                    'picture' => $item->picture,
                    'amount' => $item->amount,
                    'account_id' => $item->account_id,
                    'status' => $item->status,
                    'description' => $item->description,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            }
        }

        return $grouped;
    }
}
