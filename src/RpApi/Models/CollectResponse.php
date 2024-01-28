<?php

namespace Jgroup\BankID\RpApi\Models;

use Jgroup\BankID\Serializers\JsonSerializer;

class CollectResponse extends JsonSerializer
{
    public ?string $orderRef = null;

    public ?string $status = null;

    public ?string $hintCode = null;

    public ?CompletionData $completionData = null;

    public function getOrderRef(): ?string
    {
        return $this->orderRef;
    }

    public function setOrderRef(string $orderRef): void
    {
        $this->orderRef = $orderRef;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getHintCode(): ?string
    {
        return $this->hintCode;
    }

    public function setHintCode(string $hintCode): void
    {
        $this->hintCode = $hintCode;
    }

    public function getCompletionData(): ?CompletionData
    {
        return $this->completionData;
    }

    public function setCompletionData(CompletionData $completionData): void
    {
        $this->completionData = $completionData;
    }
}
