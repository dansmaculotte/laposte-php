<?php

namespace DansMaCulotte\LaPoste;

use GuzzleHttp\Client as HttpClient;

class Client
{
    const API_URL = 'https://api.laposte.fr';

    public $client;

    public function __construct($apiKey)
    {
        $this->client = new HttpClient(
            [
                'base_uri' =>  self::API_URL,
                'headers' => array(
                    'X-Okapi-Key' => $apiKey,
                ),
            ]
        );
    }
}