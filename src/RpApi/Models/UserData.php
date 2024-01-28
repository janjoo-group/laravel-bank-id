<?php

namespace Jgroup\BankID\RpApi\Models;

use Jgroup\BankID\Serializers\JsonSerializer;

class UserData extends JsonSerializer
{
    public ?string $personalNumber = null;

    public ?string $name = null;

    public ?string $givenName = null;

    public ?string $surname = null;

    public function getPersonalNumber(): ?string
    {
        return $this->personalNumber;
    }

    public function setPersonalNumber(string $personalNumber): void
    {
        $this->personalNumber = $personalNumber;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = trim($name);
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setGivenName(string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }
}
