<?php

namespace client\core;

use client\ApiClient;
use GuzzleHttp\Exception\GuzzleException;
use models\Response;

class Account
{
    private ?ApiClient $client = null;

    /**
     * @param array $post
     * @return Response|null
     * @throws GuzzleException
     */
    public function get(array $post = []): ?Response
    {
        return $this?->getClient()?->sendRequest(
            'account',
            $post,
        );
    }

    /**
     * @param array $post
     * @return array
     * @throws GuzzleException
     */
    public function getBalances(array $post = []): array
    {
        $request = $this->get($post);

        if ($request->isSuccess()) {
            return $request->body['balances'];
        }

        return [];
    }

    /**
     * @return ApiClient|null
     */
    private function getClient(): ?ApiClient
    {
        if ($this->client === null) {
            $this->client = new ApiClient();
        }

        return $this->client;
    }
}