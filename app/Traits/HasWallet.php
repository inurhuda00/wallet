<?php

namespace App\Traits;

use App\Enums\TransactionType;
use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidAmountException;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;

trait HasWallet
{
    public function deposit(int|float $amount): float|int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        DB::beginTransaction();

        try {
            $transaction = new Transaction;
            $transaction->user_id = $this->id;
            $transaction->type = TransactionType::DEPOSIT;
            $transaction->add = $amount;
            $transaction->total = $this->balance() + $amount;
            $transaction->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return $this->balance();
    }

    public function withdraw(int|float $amount): float|int
    {
        $this->canWithdraw($amount);
        $this->throwExceptionIfBalanceIsInsufficient($amount);

        DB::beginTransaction();

        try {
            $transaction = new Transaction;
            $transaction->user_id = $this->id;
            $transaction->type = TransactionType::WITHDRAW;
            $transaction->add = -$amount;
            $transaction->total = $this->balance() - $amount;
            $transaction->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return $this->balance();
    }

    public function canWithdraw(int|float $amount): bool
    {

        $balance = $this->balance() ?? 0;

        return $balance >= $amount;
    }

    public function balance(): int|float
    {
        return $this->transactions->sum('add');
    }

    public function total() {
        
        return $this->transactions->last()->total ?? 0;
    }

    public function throwExceptionIfAmountIsInvalid(int|float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException();
        }
    }

    public function throwExceptionIfBalanceIsInsufficient(int|float $amount): void
    {
        if (! $this->canWithdraw($amount)) {
            throw new InsufficientBalanceException();
        }
    }
}
