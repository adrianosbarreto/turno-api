<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserDataAPIRequest;
use App\Http\Resources\UserDataResource;
use App\Models\Account;
use App\Services\AccountServicesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AccountAPIController extends Controller
{
    private AccountServicesInterface $accountService;

    public function __construct(AccountServicesInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index(Request $request): JsonResponse
    {
        $userDatas = $this->accountService->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(UserDataResource::collection($userDatas), 'User Datas retrieved successfully');
    }


    public function store(CreateUserDataAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $userData = $this->accountService->create($input);

        return $this->sendResponse(new UserDataResource($userData), 'User Data saved successfully');
    }


    public function show($id): JsonResponse
    {
        /** @var Account $userData */
        $userData = $this->accountService->find($id)->with('user');

        if (empty($userData)) {
            return $this->sendError('User Data not found');
        }

        return $this->sendResponse(new UserDataResource($userData), 'User Data retrieved successfully');
    }


    public function balance($id): JsonResponse
    {
        $balance = $this->accountService->getBalance($id);

        return $this->sendResponse(['balance' => $balance], 'Balance retrieved successfully');

    }
}
