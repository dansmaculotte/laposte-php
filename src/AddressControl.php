<?php

namespace DansMaCulotte\LaPoste;

/**
 * Implementation of ControlAdresse Web Service
 * https://developer.laposte.fr/products/controladresse/latest
 */
class AddressControl extends Client
{
    const SERVICE_URI = '/controladresse/v1/adresses';

    /**
     * Construct Method
     *
     * @param string $apiKey La Poste Developer API Key
     */
    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Find an address matching with the selector
     *
     * @param string $address An address located in France.
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find(string $address)
    {
        $response = $this->client->request(
            'GET',
            self::SERVICE_URI,
            [
                'query' => [
                    'q' => $address
                ]
            ]
        );

        $body = json_decode((string) $response->getBody(), true);

        return $body;
    }

    /**
     * Get details on a specific address
     *
     * @param string $code A code of an address
     *
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detail(string $code)
    {
        $response = $this->client->request(
            'GET',
            self::SERVICE_URI. '/' . $code
        );

        $body = json_decode((string) $response->getBody(), true);

        return $body;
    }
}
