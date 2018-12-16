<?php

use PHPUnit\Framework\TestCase;
use DansMaCulotte\LaPoste\AddressControl;

require 'Credentials.php';

class AddressControlTest extends TestCase
{
    public $apiKey = API_KEY;

    public function testFind()
    {
        $laposteAddressControl = new AddressControl($this->apiKey);
        $results = $laposteAddressControl->find('7 rue Mélingue 14000 Caen');

        print_r($results);
    }

    public function testDetail()
    {
        $laposteAddressControl = new AddressControl($this->apiKey);
        $results = $laposteAddressControl->detail('260621288');

        print_r($results);
    }
}