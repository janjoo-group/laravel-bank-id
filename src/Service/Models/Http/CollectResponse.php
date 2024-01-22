<?php

namespace Jgroup\BankID\Service\Models\Http;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;
use Jgroup\BankID\Service\Models\CollectResult;

class CollectResponse implements Responsable
{
    protected string $transactionId;

    protected ?string $hintCode = null;

    protected ?string $status = null;

    protected ?string $qrCode = null;

    protected CollectResult $collectResult;

    protected ?CompletionResponse $completionResponse = null;

    public function __construct(string $transactionId, CollectResult $collectResult)
    {
        $this->transactionId = $transactionId;
        $this->hintCode      = $collectResult->getHintCode();
        $this->status        = $collectResult->getStatus();
        $this->qrCode        = $collectResult->getQrCode();
        $this->collectResult = $collectResult;

        if ($collectResult->getCompletionResult()) {
            $this->completionResponse = new CompletionResponse($collectResult->getCompletionResult());
        }
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getHintCode(): ?string
    {
        return $this->hintCode;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    public function getCollectResult(): CollectResult
    {
        return $this->collectResult;
    }

    public function getCompletionResponse(): ?CompletionResponse
    {
        return $this->completionResponse;
    }

    public function toArray(): array
    {
        return array_filter([
            'transactionId'      => $this->transactionId,
            'hintCode'           => $this->hintCode,
            'status'             => $this->status,
            'qrCode'             => $this->qrCode,
            'completionResponse' => $this->completionResponse
                ? $this->completionResponse->toArray()
                : null,
        ], function ($value) {
            return !is_null($value);
        });
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
