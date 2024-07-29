<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateCheckAPIRequest;
use App\Http\Requests\UpdateCheckAPIRequest;
use App\Models\Check;
use App\Repo\CheckRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CheckAPIController
 */
class CheckAPIController extends Controller
{
    /** @var  CheckRepository */
    private $checkRepository;

    public function __construct(CheckRepository $checkRepo)
    {
        $this->checkRepository = $checkRepo;
    }

    /**
     * Display a listing of the Checks.
     * GET|HEAD /checks
     */
    public function index(Request $request): JsonResponse
    {
        $checks = $this->checkRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($checks, 'Checks retrieved successfully');
    }

    /**
     * Store a newly created Check in storage.
     * POST /checks
     */
    public function store(CreateCheckAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $check = $this->checkRepository->create($input);

        return $this->sendResponse($check, 'Check saved successfully');
    }

    /**
     * Display the specified Check.
     * GET|HEAD /checks/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Check $check */
        $check = $this->checkRepository->find($id);

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
        $check = $this->checkRepository->find($id);

        if (empty($check)) {
            return $this->sendError('Check not found');
        }

        $check = $this->checkRepository->update($input, $id);

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
        $check = $this->checkRepository->find($id);

        if (empty($check)) {
            return $this->sendError('Check not found');
        }

        $check->delete();

        return $this->sendSuccess('Check deleted successfully');
    }
}
