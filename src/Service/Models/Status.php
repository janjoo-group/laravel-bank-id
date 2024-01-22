<?php

namespace Jgroup\BankID\Service\Models;

class Status
{
    const PENDING = 'pending';

    const FAILED = 'failed';

    const COMPLETE = 'complete';

    public static function fromString(string $status): string
    {
        $statuses = [
            self::PENDING,
            self::FAILED,
            self::COMPLETE,
        ];

        foreach ($statuses as $s) {
            $s = strtolower($s);

            if ($s === strtolower($status)) {
                return $s;
            }
        }

        return self::PENDING;
    }
}
