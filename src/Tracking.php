<?php

namespace DansMaCulotte\LaPoste;

/**
 * Implementation of "Suivi" (Tracking) Web Service
 * https://developer.laposte.fr/products/suivi/latest
 */
class Tracking extends Client
{
    const SERVICE_URI = '/suivi/v1';

    /**
     * Construct Method
     *
     * @param string $apiKey La Poste Developer API Key
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Get the status of a shipping from his unique tracking code.
     *
     * @param string $code A shipping code
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function track(string $code)
    {
        $response = $this->client->request(
            'GET',
            self::SERVICE_URI,
            [
                'query' => [
                    'code' => $code
                ]
            ]
        );

        $body = json_decode((string) $response->getBody(), true);

        return $body;
    }

    /**
     * Get the status of a list of shipping from their unique tracking code.
     *
     * @param array $codeList An array of shipping codes
     *
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function trackList(array $codeList)
    {
        $response = $this->client->request(
            'GET',
            self::SERVICE_URI . "/list",
            [
                'query' => [
                    'codes' => implode(',', $codeList)
                ]
            ]
        );

        $body = json_decode((string) $response->getBody(), true);

        return $body;
    }
}