<?php

namespace Jgroup\BankID\RpApi\Models;

use Jgroup\BankID\Serializers\JsonSerializer;

class SetUpData extends JsonSerializer
{
    public ?boolean $mrtd = null;

    public function getMrtd(): ?boolean
    {
        return $this->mrtd;
    }

    public function setMrtd(boolean $mrtd): void
    {
        $this->mrtd = $mrtd;
    }
}
