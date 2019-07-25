<?php

namespace DansMaCulotte\LaPoste\Tests;

use DansMaCulotte\LaPoste\AddressControl;

class AddressControlTest extends TestCase
{
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
