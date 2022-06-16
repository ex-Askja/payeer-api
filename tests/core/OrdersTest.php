<?php

namespace core;

use client\core\Orders;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class OrdersTest extends TestCase
{
    /**
     * @return void
     * @throws GuzzleException
     */
    public function testGetAll(): void
    {
        $orders = new Orders();

        $request = $orders->getAll([
            'pair' => 'BTC_USDT'
        ]);

        Assert::assertEquals(true, $request->isSuccess());
    }
}
