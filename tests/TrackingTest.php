<?php

namespace DansMaCulotte\LaPoste\Tests;

use DansMaCulotte\LaPoste\Tracking;

class TrackingTest extends TestCase
{
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
