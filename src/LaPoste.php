<?php

namespace DansMaCulotte\LaPoste;

use GuzzleHttp\Client as HttpClient;

class LaPoste
{
    /** @var string */
    const API_URL = 'https://api.laposte.fr';

    /** @var HttpClient */
    public $httpClient;

    /**
     * Construct Method
     *
     * @param string $apiKey La Poste Developer API Key
     */
    public function __construct(string $apiKey)
    {
        $this->httpClient = new HttpClient(
            [
                'base_uri' =>  self::API_URL,
                'headers' => [
                    'X-Okapi-Key' => $apiKey,
                ],
            ]
        );
    }
}
