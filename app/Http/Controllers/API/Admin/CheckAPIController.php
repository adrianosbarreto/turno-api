<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateCheckAPIRequest;
use App\Http\Requests\UpdateCheckAPIRequest;
use App\Http\Resources\CheckResource;
use App\Http\Resources\CheckViewResource;
use App\Models\Check;
use App\Repo\CheckRepositoryInterface;
use App\Repositories\CheckRepository;
use App\Services\CheckService;
use App\Services\CheckServicesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CheckAPIController
 */
class CheckAPIController extends Controller
{
    /** @var  CheckRepository */
    private $checkService;

    public function __construct(CheckServicesInterface $checkService)
    {
        $this->checkService = $checkService;
    }

    /**
     * Display a listing of the Checks.
     * GET|HEAD /checks
     */
    public function index(Request $request): JsonResponse
    {
        $account_id = $request->input('account_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $checks = $this->checkService->filterByMonthYear($account_id, $month, $year);

        return $this->sendResponse(new CheckResource($checks), 'Checks retrieved successfully');
    }

    public function getPendingChecks(Request $request): JsonResponse
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $checks = $this->checkService->getCheckByStatus('pending', $month, $year);

        return $this->sendResponse($checks, 'Checks retrieved successfully');

    }

    public function approveCheck($id)
    {
        $check = $this->checkService->approveCheck($id);

        return $this->sendResponse($check, 'Check approved successfully');
    }

    public function rejectCheck($id)
    {
        $check = $this->checkService->rejectCheck($id);

        return $this->sendResponse($check, 'Check rejected successfully');
    }

    /**
     * Store a newly created Check in storage.
     * POST /checks
     */
    public function store(\App\Http\Requests\CreateCheckAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $check = $this->checkService->addCheck($input);

        return $this->sendResponse($check, 'Check saved successfully');
    }

    /**
     * Display the specified Check.
     * GET|HEAD /checks/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Check $check */


        $check = $this->checkService->getCheckById($id);


        if (empty($check)) {
            return $this->sendError('Check not found');
        }

        return $this->sendResponse(new CheckViewResource($check), 'Check retrieved successfully');
    }

}
