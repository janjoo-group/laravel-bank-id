<?php

namespace Jgroup\BankID\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Jgroup\BankID\Service\Models\Http\TransactionResponse auth(string $endUserIp, string $userVisibleData = null, string $userVisibleDataFormat = null, string $userNonVisibleData = null, array $requirement = null)
 * @method static \Jgroup\BankID\Service\Models\Http\TransactionResponse sign(string $endUserIp, string $userVisibleData, string $userVisibleDataFormat = null, string $userNonVisibleData = null, array $requirement = null)
 * @method static \Jgroup\BankID\Service\Models\Http\CollectResponse collect()
 * @method static \Jgroup\BankID\Service\Models\Http\CancelResponse cancel()
 * @method static \Jgroup\BankID\Service\Models\BankIDTransaction getSessionTransaction()
 * @method static void setSessionTransaction(\Jgroup\BankID\Service\Models\BankIDTransaction $transaction)
 *
 * @see \Jgroup\BankID\Service\BankIDService
 */
class BankID extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bankid';
    }
}
