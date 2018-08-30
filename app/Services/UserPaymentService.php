<?php

namespace App\Services;


use App\Models\UserPayment;
use Illuminate\Support\Facades\Auth;

class UserPaymentService
{
    /**
     * @param int $amount
     * @param $comment
     * @return mixed
     */
    public function increaseBalance(int $amount, $comment)
    {
        $lastBalance = $this->checkBalance();
        if ($lastBalance == null) {
            // add initial record with balance 0
            return $this->makePayment(Auth::id(), 'credit', 0, $amount, $comment);
        }

        // insert new record
        return $this->makePayment(Auth::id(), 'credit', $lastBalance, $lastBalance + $amount, $comment);
    }

    /**
     * @param int $amount
     * @param $comment
     * @return bool
     */
    public function decreaseBalance(int $amount, $comment)
    {
        $lastBalance = $this->checkbalance();

        if ($lastBalance == null || $lastBalance < $amount) {
            return false;
        }

        // insert new record
        return $this->makePayment(Auth::id(), 'debit', $lastBalance, $lastBalance - $amount, $comment);
    }

    /**
     * checking last record in user payments
     * @return null|integer
     */
    private function checkBalance()
    {
        // check if there is records in table or not
        $lastBalance = UserPayment::where('user_id', Auth::id())->latest()->first();

        if (empty($lastBalance)) {
            return null;
        }

        return $lastBalance->balance_after;
    }

    /**
     * @param int $user_id
     * @param string $type
     * @param int $beforeBalance
     * @param int $afterBalance
     * @param $comment
     * @return mixed
     */
    private function makePayment(int $user_id, string $type, int $beforeBalance, int $afterBalance, $comment)
    {
        return UserPayment::create([
            'user_id' => $user_id,
            'type' => $type,
            'balance_before' => $beforeBalance,
            'balance_after' => $afterBalance,
            'comment' => $comment
        ]);
    }

}