<?php

namespace client;

use Exception;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use models\Response;

class ApiClient
{
    private ?Request $request = null;
    private string $baseUri = 'https://payeer.com/api/trade/';
    private string $apiId = '1681441954';
    private string $secretKey = "TMQ9NmwhOn87lc8y";

    /**
     * @param string $method
     * @param array $additionalData
     * @return Response|null
     * @throws GuzzleException
     * @throws Exception
     */
    public function sendRequest(string $method, array $additionalData = []): ?Response
    {
        $response = null;

        $request = $this?->getRequest()?->request(
            'POST',
            $this->getBaseUri() . $method,
            array_merge([
                'ts' => round(microtime(true) * 1000),
            ], $additionalData),
            [
                'API-ID' => $this->getApiId(),
                'API-SIGN' => $this->makeSign($method, $additionalData),
            ]
        );

        if ($request->getStatusCode() >= 200 && $request->getStatusCode() <= 299) {
            $response = new Response(
                $request->getStatusCode(),
                $request->getBody()
            );
        }

        return $response;
    }

    /**
     * @param string $method
     * @param array $post
     * @return string
     */
    private function makeSign(string $method, array $post): string
    {
        return hash_hmac('sha256', $method . json_encode($post), $this->getSecretKey());
    }

    /**
     * @return Request|null
     */
    public function getRequest(): ?Request
    {
        if ($this->request === null) {
            $this->request = new Request();
        }

        return $this->request;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    public function getApiId(): string
    {
        return $this->apiId;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}