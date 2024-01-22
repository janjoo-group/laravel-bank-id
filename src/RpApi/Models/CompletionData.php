<?php

namespace Jgroup\BankID\RpApi\Models;

class CompletionData
{
    protected ?UserData $user = null;

    protected ?DeviceData $device = null;

    protected ?SetUpData $setUp = null;

    protected ?string $bankIdIssueDate = null;

    protected ?string $signature = null;

    protected ?string $ocspResponse = null;

    public function getUser(): ?UserData
    {
        return $this->user;
    }

    public function setUser(UserData $user): void
    {
        $this->user = $user;
    }

    public function getDevice(): ?DeviceData
    {
        return $this->device;
    }

    public function setDevice(DeviceData $device): void
    {
        $this->device = $device;
    }

    public function getSetUp(): ?SetUpData
    {
        return $this->setUp;
    }

    public function setSetUp(SetUpData $setUp): void
    {
        $this->setUp = $setUp;
    }

    public function getBankIdIssueDate(): ?string
    {
        return $this->bankIdIssueDate;
    }

    public function setBankIdIssueDate(string $bankIdIssueDate): void
    {
        $this->bankIdIssueDate = $bankIdIssueDate;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): void
    {
        $this->signature = $signature;
    }

    public function getOcspResponse(): ?string
    {
        return $this->ocspResponse;
    }

    public function setOcspResponse(string $ocspResponse): void
    {
        $this->ocspResponse = $ocspResponse;
    }
}
