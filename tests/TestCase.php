<?php

namespace DansMaCulotte\LaPoste\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /** @var string */
    protected $apiKey;

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::create(dirname(dirname(__FILE__)));
        $dotenv->load();

        $this->apiKey = getenv('API_KEY');
    }
}
