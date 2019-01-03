<?php

use PHPUnit\Framework\TestCase;
use DansMaCulotte\LaPoste\AddressControl;

require_once 'Credentials.php';

class AddressControlTest extends TestCase
{
    public $apiKey = API_KEY;

    public function testFind()
    {
        $addressControlClient = new AddressControl($this->apiKey);
        $results = $addressControlClient->find('7 rue Mélingue 14000 Caen');

        print_r($results);
    }

    public function testDetail()
    {
        $addressControlClient = new AddressControl($this->apiKey);
        $results = $addressControlClient->detail('271839461');

        print_r($results);
    }
}