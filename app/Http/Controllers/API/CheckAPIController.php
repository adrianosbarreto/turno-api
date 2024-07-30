<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateCheckAPIRequest;
use App\Http\Requests\UpdateCheckAPIRequest;
use App\Http\Resources\CheckResource;
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
        $check = $this->checkService->find($id);

        if (empty($check)) {
            return $this->sendError('Check not found');
        }

        return $this->sendResponse($check, 'Check retrieved successfully');
    }

    /**
     * Update the specified Check in storage.
     * PUT/PATCH /checks/{id}
     */
    public function update($id, UpdateCheckAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Check $check */
        $check = $this->checkService->find($id);

        if (empty($check)) {
            return $this->sendError('Check not found');
        }

        $check = $this->checkService->update($input, $id);

        return $this->sendResponse($check, 'Check updated successfully');
    }

    /**
     * Remove the specified Check from storage.
     * DELETE /checks/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Check $check */
        $check = $this->checkService->find($id);

        if (empty($check)) {
            return $this->sendError('Check not found');
        }

        $check->delete();

        return $this->sendSuccess('Check deleted successfully');
    }

    public function filterByStatus(Request $request): JsonResponse
    {
        $checks = $this->checkService->filter(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($checks, 'Checks retrieved successfully');
    }

    public function monthYearFilter(Request $request): JsonResponse
    {
        $checks = $this->checkService->filter(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($checks, 'Checks retrieved successfully');
    }
}
