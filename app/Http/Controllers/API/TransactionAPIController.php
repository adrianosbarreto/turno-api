<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTransactionAPIRequest;
use App\Http\Requests\UpdateTransactionAPIRequest;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionServicesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TransactionAPIController
 */
class TransactionAPIController extends Controller
{
    /** @var  TransactionServicesInterface */
    private TransactionServicesInterface $transactionService;

    public function __construct(TransactionServicesInterface $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the Transactions.
     * GET|HEAD /transactions
     */
    public function index(Request $request): JsonResponse
    {

        $transactions = $this->transactionService->transactionsByAccount(4);

        return $this->sendResponse( new TransactionCollection($transactions), 'Transactions retrieved successfully');
    }

    public function filter(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'nullable|in:income,expense',
            'month' => 'nullable|integer',
            'year' => 'nullable|integer'
        ]);

        $transactions = $this->transactionService->transactionsByAccountAndTypeOrMonthOrYear(
            4,
            $request->type,
            $request->month,
            $request->year
        );


        return $this->sendResponse( new TransactionCollection($transactions), 'Transactions retrieved successfully');
    }

    /**
     * Store a newly created Transaction in storage.
     * POST /transactions
     */
    public function store(CreateTransactionAPIRequest $request): JsonResponse
    {

        $input = $request->all();
        $type = $input['type'];

        try {
            if ($type === 'income') {
                $transaction = $this->transactionService->addIncome($input);
            } elseif ($type === 'expense') {
                $transaction = $this->transactionService->addPurchase($input);
            } else {
                return $this->sendError('Invalid transaction type', 400);
            }

            return $this->sendResponse(new TransactionResource($transaction), 'Transaction saved successfully');
        } catch (\Exception $e) {

            return $this->sendError('Failed to process the transaction. Please try again later.', 500);
        }
    }

    /**
     * Display the specified Transaction.
     * GET|HEAD /transactions/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Transaction $transaction */
        $transaction = $this->transactionService->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        return $this->sendResponse(new TransactionResource($transaction), 'Transaction retrieved successfully');
    }

    /**
     * Update the specified Transaction in storage.
     * PUT/PATCH /transactions/{id}
     */
    public function update($id, UpdateTransactionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $transaction = $this->transactionService->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction = $this->transactionService->update($input, $id);

        return $this->sendResponse(new TransactionResource($transaction), 'Transaction updated successfully');
    }

    /**
     * Remove the specified Transaction from storage.
     * DELETE /transactions/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Transaction $transaction */
        $transaction = $this->transactionService->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction->delete();

        return $this->sendSuccess('Transaction deleted successfully');
    }
}
