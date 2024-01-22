<?php

namespace Jgroup\BankID\Service\Models\Http;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;
use Jgroup\BankID\Service\Models\CompletionResult;

class CompletionResponse implements Responsable
{
    const NUMBER_OF_DIGITS_TO_HIDE = 4;

    protected string $name;

    protected string $personalNumber;

    public function __construct(CompletionResult $completionResult)
    {
        $this->name = $completionResult->getName();

        $personalNumber = $completionResult->getPersonalNumber();

        if ($personalNumber != null && strlen($personalNumber) > self::NUMBER_OF_DIGITS_TO_HIDE) {
            $digitsToSave         = strlen($personalNumber) - self::NUMBER_OF_DIGITS_TO_HIDE;
            $this->personalNumber = substr($personalNumber, 0, $digitsToSave) . "-XXXX";
        } else {
            $this->personalNumber = $personalNumber;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPersonalNumber(): string
    {
        return $this->personalNumber;
    }

    public function toArray(): array
    {
        return [
            'name'           => $this->name,
            'personalNumber' => $this->personalNumber,
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
