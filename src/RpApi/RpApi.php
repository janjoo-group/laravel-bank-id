<?php

namespace Jgroup\BankID\RpApi;

use stdClass;
use JsonMapper;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use Jgroup\BankID\RpApi\Models\AuthRequest;
use Jgroup\BankID\RpApi\Models\SignRequest;
use Illuminate\Http\Response as HttpResponse;
use Jgroup\BankID\RpApi\Models\CancelRequest;
use GuzzleHttp\Exception\BadResponseException;
use Jgroup\BankID\RpApi\Models\CollectRequest;
use Jgroup\BankID\RpApi\Models\CollectResponse;
use Jgroup\BankID\RpApi\Models\StartTransactionResponse;

class RpApi
{
    protected ClientInterface $httpClient;

    protected string $baseUrl;

    protected string $certPath;

    protected string $certKeyPath;

    protected string $caCertPath;

    public function __construct(
        ClientInterface $httpClient,
        string $baseUrl,
        string $certPath,
        string $certKeyPath,
        string $caCertPath,
        JsonMapper $mapper
    ) {
        $this->httpClient  = $httpClient;
        $this->baseUrl     = $baseUrl;
        $this->certPath    = $certPath;
        $this->certKeyPath = $certKeyPath;
        $this->caCertPath  = $caCertPath;
        $this->mapper      = $mapper;
    }

    public function auth(AuthRequest $request): ?StartTransactionResponse
    {
        try {
            $response = $this->performRequest('auth', $request->toArray());
        } catch (BadResponseException $e) {
            return null;
        }

        $response = $this->mapper->map(
            $this->unwrapResponse($response),
            StartTransactionResponse::class
        );

        return $response;
    }

    public function sign(SignRequest $request): ?StartTransactionResponse
    {
        try {
            $response = $this->performRequest('sign', $request->toArray());
        } catch (BadResponseException $e) {
            return null;
        }

        $response = $this->mapper->map(
            $this->unwrapResponse($response),
            StartTransactionResponse::class
        );

        return $response;
    }

    public function collect(CollectRequest $request): ?CollectResponse
    {
        try {
            $response = $this->performRequest('collect', $request->toArray());
        } catch (BadResponseException $e) {
            return null;
        }

        $response = $this->mapper->map(
            $this->unwrapResponse($response),
            CollectResponse::class
        );

        return $response;
    }

    public function cancel(CancelRequest $request): bool
    {
        try {
            $response = $this->performRequest('cancel', $request->toArray());
        } catch (BadResponseException $e) {
            return false;
        }

        return $response->getStatusCode() === HttpResponse::HTTP_OK;
    }

    public function checkConnectionWorks(): bool
    {
        try {
            $response = $this->httpClient->get('auth');
        } catch (BadResponseException $e) {
            if ($e->getResponse()->getStatusCode() !== HttpResponse::HTTP_METHOD_NOT_ALLOWED) {
                return false;
            }
        }

        return true;
    }

    protected function unwrapResponse(Response $response): stdClass
    {
        return json_decode($response->getBody()->getContents());
    }

    protected function performRequest(string $url, array $params): ?Response
    {
        try {
            return $this->httpClient->post($url, [
                RequestOptions::JSON => $params,
            ]);
        } catch (ConnectException $e) {
            return null;
        }
    }
}
