<?php

namespace App\Services;

use App\Repositories\CheckRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class CheckService implements CheckServicesInterface
{
    private CheckRepository $checkRepository;
    private TransactionService $transactionService;

    public function __construct(CheckRepository $checkRepository, TransactionService $transactionService)
    {
        $this->checkRepository = $checkRepository;
        $this->transactionService = $transactionService;
    }

    public function filterByMonthYear($account_id, $month, $year) : Collection
    {
        return $this->checkRepository->getChecksByMonthYear($account_id, $month, $year);
    }

    public function addCheck($data)
    {

        return $this->checkRepository->create($data);
    }

    public function approveCheck($id)
    {
        try {
            $check = $this->checkRepository->find($id);


            $dataIncome = [
                'account_id' => $check->account_id,
                'amount' => $check->amount,
                'description' => 'Check: ' . $check->description,
                'type' => 'income',
                'check_id' => $check->id
            ];

            $income = $this->transactionService->addIncome($dataIncome);

            $check->status = 'accept';
            $check->income_id = $income->id;
            $check->save();

        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $check->load('income');
    }

    public function rejectCheck($id)
    {
        $check = $this->checkRepository->find($id);

        $check->status = 'reject';
        $check->save();

        return $check;
    }

    public function getCheckByStatus($status, $month, $year)
    {
        return $this->checkRepository->getCheckByStatus($status, $month, $year);

    }

    public function storeImageCheck($image)
    {
        if (!empty($image)) {

            $fileName = 'image_' . uniqid(date('HisYmd')) . '.png';

            $dataImg = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

            $uploadedPath = Storage::disk('s3')->put($fileName, $dataImg);

            return \Illuminate\Support\Facades\Storage::disk('s3')->url($fileName);
        }

        return null;
    }

    public function getCheckById($id)
    {
        return $this->checkRepository->getCheckById($id);
    }

    public function createIncomeByCheck($id)
    {
        $check = $this->checkRepository->find($id);

        if ($check->status == 'approved') {
            $check->account->balance += $check->value;
            $check->account->save();
        }
        return ;
    }
}
