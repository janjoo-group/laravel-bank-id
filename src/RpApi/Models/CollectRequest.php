<?php

namespace Jgroup\BankID\RpApi\Models;

class CollectRequest
{
    protected string $orderRef;

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

    public function toArray()
    {
        return [
            'orderRef' => $this->getOrderRef(),
        ];
    }
}
