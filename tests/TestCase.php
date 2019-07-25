<?php

namespace DansMaCulotte\LaPoste\Tests;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /** @var string */
    protected $apiKey;

    protected function setUp(): void
    {
        parent::setUp();

//        $dotenv = Dotenv::create(dirname(dirname(__FILE__)));
//        $dotenv->load();
//
//        $this->apiKey = getenv('API_KEY');
        $this->apiKey = 'testing';
    }

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
