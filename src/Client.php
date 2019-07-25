<?php

namespace DansMaCulotte\LaPoste;

use GuzzleHttp\Client as HttpClient;

class Client
{
    /** @var string */
    const API_URL = 'https://api.laposte.fr';

    /** @var HttpClient */
    public $client;

    /**
     * Construct Method
     *
     * @param string $apiKey La Poste Developer API Key
     */
    public function __construct(string $apiKey)
    {
        $this->client = new HttpClient(
            [
                'base_uri' =>  self::API_URL,
                'headers' => [
                    'X-Okapi-Key' => $apiKey,
                ],
            ]
        );
    }
}
