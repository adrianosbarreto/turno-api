<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use App\Rules\SufficientBalance;
use App\Services\AccountService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTransactionAPIRequest extends BaseAPIRequest
{
    protected AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        parent::__construct();
        $this->accountService = $accountService;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_id' => 'required|min:1|exists:accounts,id',
            'type' => 'required',
            'description' => 'required|nullable',
            'amount' => ['required', 'numeric', 'min:0.01', new SufficientBalance($this->account_id, $this->type, $this->accountService)]
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        $response = response()->json([
//            'success' => false,
//            'message' => $validator->errors()->first(),
//            'errors' => $validator->errors()
//        ], 200);
//
//        throw new HttpResponseException($response);
//    }
}
