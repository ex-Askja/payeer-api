<?php

namespace client;

class BaseApiRequest
{
    private ?ApiClient $client = null;

    /**
     * @return ApiClient|null
     */
    protected function getClient(): ?ApiClient
    {
        if ($this->client === null) {
            $this->client = new ApiClient();
        }

        return $this->client;
    }
}