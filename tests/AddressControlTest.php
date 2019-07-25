<?php

namespace DansMaCulotte\LaPoste\Tests;

use DansMaCulotte\LaPoste\AddressControl;
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
        $addressControlClient->client = $this->buildClientMock($mock);

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
        $addressControlClient->client = $this->buildClientMock($mock);

        $results = $addressControlClient->detail('365771552');

        $this->assertArrayHasKey('destinataire', $results);
        $this->assertArrayHasKey('pointRemise', $results);
        $this->assertArrayHasKey('numeroVoie', $results);
        $this->assertArrayHasKey('libelleVoie', $results);
        $this->assertArrayHasKey('lieuDit', $results);
        $this->assertArrayHasKey('codePostal', $results);
        $this->assertArrayHasKey('codeCedex', $results);
        $this->assertArrayHasKey('commune', $results);
        $this->assertArrayHasKey('blocAdresse', $results);
        $this->assertCount(2, $results['blocAdresse']);
    }
}
