<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAPIRequest;
use App\Services\AccountServicesInterface;
use Illuminate\Http\Request;
use \App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterAPIController extends Controller
{

    private AccountServicesInterface $accountService;
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function __construct(AccountServicesInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return $this->sendError($validator->errors());
        }

        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        $user->assignRole('customer');

        return $this->sendResponse($user, 'User saved successfully');

    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(LoginAPIRequest $request)
    {


        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized',
                'success' => false
            ], 401);


        $user = $request->user();


        $rolesName = $user->getRoleNames();
        $permissions = $user->getPermissionsViaRoles();
        $tokenResult = $user->createToken('Personal Access Token');
        $plainTextToken = $tokenResult->plainTextToken;
        $accessToken = $tokenResult->accessToken;


        $account = $this->accountService->accountByUserId($user->id);

        if ($request->remember_me) {
            $accessToken->expires_at = Carbon::now()->addWeeks(1);
            $accessToken->save();
        }

        return $this->sendResponse([
            'user_type' => $rolesName[0],
            'username' => $user->username,
            'email' => $user->email,
            'access_token' => $plainTextToken,
            'token_type' => 'Bearer',
            'account_id' => $account->id,
            'expires_at' => Carbon::parse(
                $accessToken->expires_at
            )->toDateTimeString(),
            'permissions' => $permissions,
            'roles' => $rolesName,
        ], 'User logged in successfully');
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
