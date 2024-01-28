<?php

namespace Jgroup\BankID\RpApi\Models;

use Jgroup\BankID\Serializers\JsonSerializer;

class CollectRequest extends JsonSerializer
{
    public string $orderRef;

    public function __construct(string $orderRef)
    {
        $this->orderRef = $orderRef;
    }

    public function getOrderRef(): string
    {
        return $this->orderRef;
    }

    public function setOrderRef(string $orderRef): void
    {
        $this->orderRef = $orderRef;
    }
}
