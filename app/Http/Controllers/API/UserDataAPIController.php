<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserDataAPIRequest;
use App\Http\Requests\UpdateUserDataAPIRequest;
use App\Http\Resources\UserDataResource;
use App\Models\UserData;
use App\Repositories\UserDataRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserDataAPIController
 */
class UserDataAPIController extends Controller
{
    /** @var  UserDataRepository */
    private $userDataRepository;

    public function __construct(UserDataRepository $userDataRepo)
    {
        $this->userDataRepository = $userDataRepo;
    }

    /**
     * Display a listing of the UserDatas.
     * GET|HEAD /user-datas
     */
    public function index(Request $request): JsonResponse
    {
        $userDatas = $this->userDataRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(UserDataResource::collection($userDatas), 'User Datas retrieved successfully');
    }

    /**
     * Store a newly created UserData in storage.
     * POST /user-datas
     */
    public function store(CreateUserDataAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $userData = $this->userDataRepository->create($input);

        return $this->sendResponse(new UserDataResource($userData), 'User Data saved successfully');
    }

    /**
     * Display the specified UserData.
     * GET|HEAD /user-datas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var UserData $userData */
        $userData = $this->userDataRepository->find($id)->with('user');

        if (empty($userData)) {
            return $this->sendError('User Data not found');
        }

        return $this->sendResponse(new UserDataResource($userData), 'User Data retrieved successfully');
    }

    /**
     * Update the specified UserData in storage.
     * PUT/PATCH /user-datas/{id}
     */
    public function update($id, UpdateUserDataAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var UserData $userData */
        $userData = $this->userDataRepository->find($id);

        if (empty($userData)) {
            return $this->sendError('User Data not found');
        }

        $userData = $this->userDataRepository->update($input, $id);

        return $this->sendResponse(new UserDataResource($userData), 'UserData updated successfully');
    }

    /**
     * Remove the specified UserData from storage.
     * DELETE /user-datas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var UserData $userData */
        $userData = $this->userDataRepository->find($id);

        if (empty($userData)) {
            return $this->sendError('User Data not found');
        }

        $userData->delete();

        return $this->sendSuccess('User Data deleted successfully');
    }
}
