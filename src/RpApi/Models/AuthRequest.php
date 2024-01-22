<?php

namespace Jgroup\BankID\RpApi\Models;

class AuthRequest
{
    protected string $endUserIp;

    protected ?string $userVisibleData = null;

    protected ?string $userVisibleDataFormat = null;

    protected ?string $userNonVisibleData = null;

    protected ?array $requirement = null;

    public function __construct(string $endUserIp)
    {
        $this->endUserIp = $endUserIp;
    }

    public function getEndUserIp(): string
    {
        return $this->endUserIp;
    }

    public function setEndUserIp(string $endUserIp): void
    {
        $this->endUserIp = $endUserIp;
    }

    public function getUserVisibleData(): ?string
    {
        return $this->userVisibleData;
    }

    public function setUserVisibleData(?string $userVisibleData): void
    {
        $this->userVisibleData = base64_encode($userVisibleData);
    }

    public function getUserVisibleDataFormat(): ?string
    {
        return $this->userVisibleDataFormat;
    }

    public function setUserVisibleDataFormat(?string $userVisibleDataFormat): void
    {
        $this->userVisibleDataFormat = $userVisibleDataFormat;
    }

    public function getUserNonVisibleData(): ?string
    {
        return $this->userNonVisibleData;
    }

    public function setUserNonVisibleData(?string $userNonVisibleData): void
    {
        $this->userNonVisibleData = base64_encode($userNonVisibleData);
    }

    public function getRequirement(): ?array
    {
        return $this->requirement;
    }

    public function setRequirement(?array $requirement): void
    {
        $this->requirement = $requirement;
    }

    public function toArray()
    {
        return array_filter([
            'endUserIp'             => $this->endUserIp,
            'userVisibleData'       => $this->userVisibleData,
            'userVisibleDataFormat' => $this->userVisibleDataFormat,
            'userNonVisibleData'    => $this->userNonVisibleData,
            'requirement'           => $this->requirement,
        ], function ($value) {
            return !is_null($value);
        });
    }
}
