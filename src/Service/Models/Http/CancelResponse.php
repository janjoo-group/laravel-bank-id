<?php

namespace Jgroup\BankID\Service\Models\Http;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;

class CancelResponse implements Responsable
{
    protected bool $wasCancelledSuccessfully;

    public function __construct(bool $wasCancelledSuccessfully)
    {
        $this->wasCancelledSuccessfully = $wasCancelledSuccessfully;
    }

    public function getWasCancelledSuccessfully(): bool
    {
        return $this->wasCancelledSuccessfully;
    }

    public function toArray(): array
    {
        return [
            //
        ];
    }

    public function toResponse($request): Response
    {
        $status = $this->wasCancelledSuccessfully ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST;

        return new Response(
            json_encode($this->toArray()),
            $status,
            ['Content-Type' => 'application/json']
        );
    }
}
