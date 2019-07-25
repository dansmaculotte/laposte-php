<?php

namespace DansMaCulotte\LaPoste\Tests;

use DansMaCulotte\LaPoste\Tracking;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class TrackingTest extends TestCase
{
    public function testTrack()
    {
        $mock = new MockHandler([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'EN_LIVRAISON',
                    'type' => 'Chronopost',
                    'code' => '1111111111111',
                    'date' => '26/01/2019',
                    'message' => 'Colis en cours de livraison',
                    'link' => 'https://www.chronopost.fr/fr/chrono_suivi_search?listeNumerosLT=1111111111111',
                ])
            )
        ]);

        $trackClient = new Tracking($this->apiKey);
        $trackClient->client = $this->buildClientMock($mock);

        $results = $trackClient->track('1111111111111');

        $this->assertArrayHasKey('status', $results);
        $this->assertArrayHasKey('type', $results);
        $this->assertArrayHasKey('code', $results);
        $this->assertArrayHasKey('date', $results);
        $this->assertArrayHasKey('message', $results);
        $this->assertArrayHasKey('link', $results);
    }

    public function testTrackList()
    {
        $mock = new MockHandler([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'data' => [
                            'status' => 'EN_LIVRAISON',
                            'type' => 'Chronopost',
                            'code' => '1111111111111',
                            'date' => '26/01/2019',
                            'message' => 'Colis en cours de livraison',
                            'link' => 'https://www.chronopost.fr/fr/chrono_suivi_search?listeNumerosLT=1111111111111',
                        ],
                    ],
                    [
                        'error' => [
                            'message' => 'Aucun produit ne correspond à votre recherche.',
                            'code' => 'RESOURCE_NOT_FOUND',
                        ],
                    ],
                ])
            )
        ]);

        $trackClient = new Tracking($this->apiKey);
        $trackClient->client = $this->buildClientMock($mock);

        $results = $trackClient->list(['1111111111111', '1111111111119']);

        $this->assertCount(2, $results);

        $this->assertArrayHasKey('data', $results[0]);
        $this->assertArrayHasKey('status', $results[0]['data']);
        $this->assertArrayHasKey('type', $results[0]['data']);
        $this->assertArrayHasKey('code', $results[0]['data']);
        $this->assertArrayHasKey('date', $results[0]['data']);
        $this->assertArrayHasKey('message', $results[0]['data']);
        $this->assertArrayHasKey('link', $results[0]['data']);

        $this->assertArrayHasKey('error', $results[1]);
        $this->assertArrayHasKey('message', $results[1]['error']);
        $this->assertArrayHasKey('code', $results[1]['error']);
    }
}
