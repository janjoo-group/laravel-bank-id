<?php

namespace Jgroup\BankID\Service\Models\Http;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;

class TransactionResponse implements Responsable
{
    protected string $transactionId;

    protected string $autoStartToken;

    public function __construct(string $transactionId, string $autoStartToken)
    {
        $this->transactionId  = $transactionId;
        $this->autoStartToken = $autoStartToken;
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getAutoStartToken(): string
    {
        return $this->autoStartToken;
    }

    public function toArray(): array
    {
        return [
            'transactionId'  => $this->transactionId,
            'autoStartToken' => $this->autoStartToken,
        ];
    }

    public function toResponse($request): Response
    {
        return new Response(
            json_encode($this->toArray()),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
