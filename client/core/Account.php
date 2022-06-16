<?php

class Account
{
    private ?ApiClient $client = null;

    /**
     * @param array $post
     * @return Response|null
     */
    public function get(array $post = []): ?Response
    {
        return $this?->getClient()?->sendRequest(
            'account',
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