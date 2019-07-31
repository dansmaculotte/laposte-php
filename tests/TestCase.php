<?php

namespace DansMaCulotte\LaPoste\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /** @var string */
    protected $apiKey = 'testing';

    /**
     * @param MockHandler $mock
     * @return Client
     */
    protected function buildClientMock(MockHandler $mock)
    {
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        return $client;
    }
}
