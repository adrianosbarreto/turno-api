<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\Income;
use App\Repositories\TransactionRepository;
use App\Repositories\ExpenseRepository;
use App\Repositories\IncomeRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TransactionService implements TransactionServicesInterface
{
    private TransactionRepository $transactionRepository;
    private IncomeRepository $incomeRepository;

    private AccountServicesInterface $accountService;

    private ExpenseRepository $expenseRepository;

    public function __construct(TransactionRepository $transactionRepository, IncomeRepository $incomeRepository,
                                ExpenseRepository $expenseRepository, AccountServicesInterface $accountService)
    {
        $this->transactionRepository = $transactionRepository;
        $this->incomeRepository = $incomeRepository;
        $this->expenseRepository = $expenseRepository;
        $this->accountService = $accountService;
    }

    public function addIncome($data)
    {
//        try {
//            return DB::transaction(function () use ($data) {
                $income = $this->incomeRepository->create(Arr::only($data, ['amount', 'description']));

                $transactionData = [
                    'account_id' => $data['account_id'],
                    'transactable_type' => $data['type'],
                    'transactable_id' => $income->id,
                ];

                $this->transactionRepository->create($transactionData);

                $this->accountService->creditAmount($data['amount'], $data['account_id']);

                $income->load('transaction');

                return $income;
//            });
//        } catch (\Exception $e) {
            // Log the error message for debugging
//            Log::error('Failed to add income: ' . $e->getMessage());

            // Throw an exception to be handled in the controller
            throw new \Exception('Failed to process the income transaction. Please try again later.');
//        }

    }

    public function addPurchase($data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $expense = $this->expenseRepository->create(Arr::only($data, ['amount', 'description']));

                $transactionData = [
                    'account_id' => $data['account_id'],
                    'transactable_type' => $data['type'],
                    'transactable_id' => $expense->id,
                ];

                $this->transactionRepository->create($transactionData);

                $this->accountService->debitAmount($data['amount'], $data['account_id']);

                $expense->load('transaction');

                return $expense;
            });
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Failed to add purchase: ' . $e->getMessage());

            // Throw an exception to be handled in the controller
            throw new \Exception('Failed to process the purchase transaction. Please try again later.');
        }
    }

    public function transactionsByAccount($account_id)
    {
        return $this->transactionRepository->with(['transactable'])->findByField('account_id', $account_id);
    }

    public function transactionsByAccountAndTypeOrMonthOrYear($account_id, $type, $month, $year)
    {
        return $this->transactionRepository->transactionsByAccountAndTypeOrMonthOrYear($account_id, $type, $month, $year);
    }


    public function createTransaction($data)
    {
        return $data;
    }

    public function updateTransaction($data, $id)
    {
        return $data;
    }

    public function deleteTransaction($id)
    {
        return $id;
    }

    public function getTransaction($id)
    {
        return $id;
    }

    public function getTransactionsByAccount($account_id)
    {
        return $account_id;
    }

    public function getTransactionsByCategory($category_id)
    {
        return $category_id;
    }

    public function getTransactionsByType($type)
    {
        return $type;
    }

    public function getTransactionsByMonthYear($month, $year)
    {
        return $month;
    }
}
