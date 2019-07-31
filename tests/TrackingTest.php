<?php

namespace DansMaCulotte\LaPoste\Tests;

use DansMaCulotte\LaPoste\Exceptions\Exception;
use DansMaCulotte\LaPoste\Resources\Status;
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
            ),
            new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'code' => 'BAD_REQUEST',
                    'message' => 'Mauvais format pour le paramètre code',
                ])
            )
        ]);

        $trackClient = new Tracking($this->apiKey);
        $trackClient->httpClient = $this->buildClientMock($mock);

        $result = $trackClient->track('1111111111111');
        $this->assertInstanceOf(Status::class, $result);

        $this->expectExceptionObject(Exception::trackingError('Mauvais format pour le paramètre code'));
        $trackClient->track('1111111111111');
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
        $trackClient->httpClient = $this->buildClientMock($mock);

        $results = $trackClient->list(['1111111111111', '1111111111119']);

        $this->assertCount(2, $results);
        $this->assertContainsOnlyInstancesOf(Status::class, $results);
    }
}
