<?php

class Orders
{
    private ?ApiClient $client = null;

    /**
     * @param array $post
     * @return Response|null
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
     */
    public function get(array $post = []): ?Response
    {
        return $this?->getClient()?->sendRequest(
            'my_orders',
            $post,
        );
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