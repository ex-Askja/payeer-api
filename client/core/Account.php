<?php

namespace client\core;

use client\BaseApiRequest;
use GuzzleHttp\Exception\GuzzleException;
use models\Response;

class Account extends BaseApiRequest
{
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
}