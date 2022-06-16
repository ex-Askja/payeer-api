<?php

namespace client\core;

use client\BaseApiRequest;
use GuzzleHttp\Exception\GuzzleException;
use models\Response;

class Orders extends BaseApiRequest
{
    /**
     * @param array $post
     * @return Response|null
     * @throws GuzzleException
     */
    public function create(array $post = []): ?Response
    {
        return $this?->getClient()?->sendRequest(
            'order_create',
            $post,
        );
    }

    /**
     * @param array $post
     * @return Response|null
     * @throws GuzzleException
     */
    public function status(array $post = []): ?Response
    {
        return $this?->getClient()?->sendRequest(
            'order_status',
            $post,
        );
    }

    /**
     * @param array $post
     * @return Response|null
     * @throws GuzzleException
     */
    public function getAll(array $post = []): ?Response
    {
        return $this?->getClient()?->sendRequest(
            'orders',
            $post,
        );
    }

    /**
     * @param array $post
     * @return Response|null
     * @throws GuzzleException
     */
    public function get(array $post = []): ?Response
    {
        return $this?->getClient()?->sendRequest(
            'my_orders',
            $post,
        );
    }
}