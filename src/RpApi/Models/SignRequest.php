<?php

namespace Jgroup\BankID\RpApi\Models;

class SignRequest extends AuthRequest
{
    public function __construct(string $endUserIp, string $userVisibleData)
    {
        parent::__construct($endUserIp);

        $this->setUserVisibleData($userVisibleData);
    }
}
