<?php

namespace client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class Request
{
    protected ?Client $client = null;

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @return ResponseInterface|null
     * @throws GuzzleException
     */
    public function request(
        string $method,
        string $uri,
        array $data = [],
        array $headers = []): ?ResponseInterface
    {
        return $this?->getClient()?->request($method, $uri, [
            'json' => $data,
            'headers' => $headers,
            'http_errors' => true,
            'verify' => false,
        ]);
    }

    /**
     * @return Client
     */
    private function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = new Client();
        }

        return $this->client;
    }
}