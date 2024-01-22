<?php

namespace Jgroup\BankID\Tests;

use Jgroup\BankID\RpApi\RpApi;
use Jgroup\BankID\RpApi\Models\AuthRequest;
use Jgroup\BankID\RpApi\Models\SignRequest;
use Jgroup\BankID\RpApi\Models\CancelRequest;
use Jgroup\BankID\RpApi\Models\CollectRequest;
use Jgroup\BankID\RpApi\Models\CollectResponse;
use Jgroup\BankID\RpApi\Models\StartTransactionResponse;

class RpApiTest extends TestCase
{
    const CLIENT_IP = '127.0.0.1';

    protected $rpApi;

    public function setUp(): void
    {
        parent::setUp();

        config([
            'bankid.use_environment' => 'test',
        ]);

        $this->rpApi = $this->app->make(RpApi::class);
    }

    public function test_it_checks_that_the_bankid_rp_api_connection_works()
    {
        $this->assertTrue($this->rpApi->checkConnectionWorks());
    }

    public function test_it_makes_one_auth_cycle()
    {
        $startTransaction = $this->rpApi->auth(new AuthRequest(self::CLIENT_IP));

        $this->assertInstanceOf(StartTransactionResponse::class, $startTransaction);
        $this->assertNotNull($startTransaction->getOrderRef());
        $this->assertNotNull($startTransaction->getAutoStartToken());
        $this->assertNotNull($startTransaction->getQrStartToken());
        $this->assertNotNull($startTransaction->getQrStartSecret());

        // Collect
        $collectResponse = $this->rpApi->collect(new CollectRequest($startTransaction->getOrderRef()));
        $this->assertNotNull($collectResponse);
        $this->assertInstanceOf(CollectResponse::class, $collectResponse);

        $this->assertNotNull($collectResponse->getOrderRef());
        $this->assertEquals($startTransaction->getOrderRef(), $collectResponse->getOrderRef());

        $this->assertNotNull($collectResponse->getStatus());
        $this->assertEquals('pending', $collectResponse->getStatus());
        $this->assertNotNull($collectResponse->getHintCode());
        $this->assertEquals('outstandingTransaction', $collectResponse->getHintCode());

        // Cancel
        $cancelResponse = $this->rpApi->cancel(new CancelRequest($startTransaction->getOrderRef()));
        $this->assertTrue($cancelResponse);
    }

    public function test_it_makes_one_sign_cycle()
    {
        $startTransaction = $this->rpApi->sign(new SignRequest(self::CLIENT_IP, 'visible'));

        $this->assertInstanceOf(StartTransactionResponse::class, $startTransaction);
        $this->assertNotNull($startTransaction->getOrderRef());
        $this->assertNotNull($startTransaction->getAutoStartToken());
        $this->assertNotNull($startTransaction->getQrStartToken());
        $this->assertNotNull($startTransaction->getQrStartSecret());

        // Collect
        $collectResponse = $this->rpApi->collect(new CollectRequest($startTransaction->getOrderRef()));
        $this->assertNotNull($collectResponse);
        $this->assertInstanceOf(CollectResponse::class, $collectResponse);

        $this->assertNotNull($collectResponse->getOrderRef());
        $this->assertEquals($startTransaction->getOrderRef(), $collectResponse->getOrderRef());

        $this->assertNotNull($collectResponse->getStatus());
        $this->assertEquals('pending', $collectResponse->getStatus());
        $this->assertNotNull($collectResponse->getHintCode());
        $this->assertEquals('outstandingTransaction', $collectResponse->getHintCode());

        // Cancel
        $cancelResponse = $this->rpApi->cancel(new CancelRequest($startTransaction->getOrderRef()));
        $this->assertTrue($cancelResponse);
    }
}
