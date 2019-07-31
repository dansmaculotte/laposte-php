<?php

namespace DansMaCulotte\LaPoste;

use DansMaCulotte\LaPoste\Exceptions\Exception;
use DansMaCulotte\LaPoste\Resources\Status;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * Implementation of "Suivi" (Tracking) Web Service
 * https://developer.laposte.fr/products/suivi/latest
 */
class Tracking extends LaPoste
{
    /** @var string */
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
     * @return Status
     * @throws Exception
     * @throws GuzzleException
     */
    public function track(string $code)
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                self::SERVICE_URI,
                [
                    'query' => [
                        'code' => $code
                    ]
                ]
            );

            $body = json_decode((string) $response->getBody(), true);

            return new Status(
                $body['code'],
                $body['date'],
                $body['status'],
                $body['message'],
                $body['link'],
                $body['type']
            );
        } catch (RequestException $e) {
            $body = json_decode($e->getResponse()->getBody(), true);
            if (isset($body['message'])) {
                throw Exception::trackingError($body['message']);
            } else {
                throw Exception::trackingError('No error message were provided');
            }
        }
    }

    /**
     * Get the status of a list of shipping from their unique tracking code.
     *
     * @param array $codes An array of shipping codes
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $codes)
    {
        $response = $this->httpClient->request(
            'GET',
            self::SERVICE_URI . '/list',
            [
                'query' => [
                    'codes' => implode(',', $codes)
                ]
            ]
        );

        $body = json_decode((string) $response->getBody(), true);

        $results = [];
        foreach ($body as $item) {
            if (isset($item['data'])) {
                $status = $item['data'];
                array_push(
                    $results,
                    new Status(
                        $status['code'],
                        $status['message'],
                        $status['date'],
                        $status['status'],
                        $status['link'],
                        $status['type']
                    )
                );
            } else if (isset($item['error'])) {
                $error = $item['error'];
                array_push(
                    $results,
                    new Status(
                        $error['code'],
                        $error['message']
                    )
                );
            }
        }

        return $results;
    }
}
