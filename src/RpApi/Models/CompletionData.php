<?php

namespace Jgroup\BankID\RpApi\Models;

use Jgroup\BankID\Serializers\JsonSerializer;

class CompletionData extends JsonSerializer
{
    public ?UserData $user = null;

    public ?DeviceData $device = null;

    public ?StepUpData $stepUp = null;

    public ?string $bankIdIssueDate = null;

    public ?string $signature = null;

    public ?string $ocspResponse = null;

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

    public function getStepUp(): ?StepUpData
    {
        return $this->stepUp;
    }

    public function setStepUp(StepUpData $stepUp): void
    {
        $this->stepUp = $stepUp;
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
