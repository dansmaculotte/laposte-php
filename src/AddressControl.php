<?php

namespace DansMaCulotte\LaPoste;

use DansMaCulotte\LaPoste\Resources\Address;

/**
 * Implementation of ControlAdresse Web Service
 * https://developer.laposte.fr/products/controladresse/latest
 */
class AddressControl extends LaPoste
{
    /** @var string */
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
        $response = $this->httpClient->request(
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
     * @return Address
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detail(string $code)
    {
        $response = $this->httpClient->request(
            'GET',
            self::SERVICE_URI. '/' . $code
        );

        $body = json_decode((string) $response->getBody(), true);

        return new Address(
            $body['destinataire'],
            $body['pointRemise'],
            $body['numeroVoie'],
            $body['libelleVoie'],
            $body['lieuDit'],
            $body['codePostal'],
            $body['codeCedex'],
            $body['commune'],
            $body['blocAdresse']
        );
    }
}
