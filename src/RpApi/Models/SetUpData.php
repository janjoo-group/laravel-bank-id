<?php

namespace Jgroup\BankID\RpApi\Models;

class SetUpData
{
    protected ?boolean $mrtd = null;

    public function getMrtd(): ?boolean
    {
        return $this->mrtd;
    }

    public function setMrtd(boolean $mrtd): void
    {
        $this->mrtd = $mrtd;
    }
}
