<?php

use GuzzleHttp\Exception\RequestException;

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
     */
    public function sendRequest(string $method, array $additionalData = []): ?Response
    {
        $response = null;

        $this?->getRequest()?->request(
            'POST',
            $this->getBaseUri(),
            array_merge([
                'method' => $method,
                'ts' => round(microtime(true) * 1000),
            ], $additionalData),
            [
                'API-ID' => $this->getApiId(),
                'API-SIGN' => $this->makeSign($method, $additionalData),
            ], function($result) use(&$response) {
                if ($result->getStatusCode() >= 200 && $result->getStatusCode() <= 299) {
                    $response = new Response(
                        $result->getStatusCode(),
                        $result->getBody()
                    );
                } else {
                    throw new RequestException("Bad http code", $result);
                }
            }
        );

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
            $this->request = new Request('GET', '');
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