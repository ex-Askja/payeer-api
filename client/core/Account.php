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
     * @param array $post
     * @return array
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