<?php

namespace DansMaCulotte\LaPoste\Tests;

use DansMaCulotte\LaPoste\AddressControl;
use DansMaCulotte\LaPoste\Resources\Address;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class AddressControlTest extends TestCase
{
    public function testFind()
    {
        $mock = new MockHandler([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    [
                        'code' => '365771552',
                        'adresse' => '7 RUE MELINGUE 14000 CAEN',
                    ],
                ])
            )
        ]);

        $addressControlClient = new AddressControl($this->apiKey);
        $addressControlClient->httpClient = $this->buildClientMock($mock);

        $results = $addressControlClient->find('7 rue Mélingue 14000 Caen');

        $this->assertCount(1, $results);
        $this->assertArrayHasKey('code', $results[0]);
        $this->assertArrayHasKey('adresse', $results[0]);
    }

    public function testDetail()
    {
        $mock = new MockHandler([
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'destinataire' => '',
                    'pointRemise' => '',
                    'numeroVoie' => '7',
                    'libelleVoie' => 'RUE MELINGUE',
                    'lieuDit' => '',
                    'codePostal' => '14000',
                    'codeCedex' => '',
                    'commune' => 'CAEN',
                    'blocAdresse' => [
                        '7 RUE MELINGUE',
                        '14000 CAEN',
                    ],
                ])
            )
        ]);

        $addressControlClient = new AddressControl($this->apiKey);
        $addressControlClient->httpClient = $this->buildClientMock($mock);

        $result = $addressControlClient->detail('365771552');

        $this->assertInstanceOf(Address::class, $result);
    }
}
