<?php

use PHPUnit\Framework\TestCase;
use DansMaCulotte\LaPoste\Tracking;

require_once 'Credentials.php';

class TrackingTest extends TestCase
{
    public $apiKey = API_KEY;

    public function testTrack()
    {
        $trackClient = new Tracking($this->apiKey);
        $results = $trackClient->track('1111111111111');

        print_r($results);
    }

    public function testTrackList()
    {
        $trackClient = new Tracking($this->apiKey);
        $results = $trackClient->list(['1111111111111', '1111111111119']);

        print_r($results);
    }
}