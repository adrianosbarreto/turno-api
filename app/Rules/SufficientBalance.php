<?php

namespace App\Rules;

use App\Enums\TransactionType;
use App\Services\AccountService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SufficientBalance implements ValidationRule
{
    protected int $account_id;
    protected string $type;
    protected AccountService $accountService;

    /**
     * Create a new rule instance.
     *
     * @param int $account_id
     * @param  string  $type
     * @return void
     */
    public function __construct(int $account_id, string $type, AccountService $accountService)
    {
        $this->account_id = $account_id;
        $this->type = $type;
        $this->accountService = $accountService;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->type !== TransactionType::EXPENSE->value) {
            return;
        }

        if ($this->accountService->getBalance($this->account_id) < $value) {
            $fail('The user does not have sufficient balance for this operation.');
        }
    }
}
