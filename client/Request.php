<?php

use GuzzleHttp\Client;
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
     * @param $callback
     */
    public function request(
        string $method,
        string $uri,
        array $data = [],
        array $headers = [],
        $callback = null): void
    {
        $promise = $this->getClient()->requestAsync($method, $uri, [
            'body' => $data,
            'headers' => $headers,
        ]);

        $promise->then(
            fn(ResponseInterface $response) => $callback($response),
            function (RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        );
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