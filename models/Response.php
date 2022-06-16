<?php

namespace models;

class Response
{
    public array|bool $errorData = false;
    public bool $successRequest = true;

    public function __construct(
        public int $httpCode,
        public array|string $body,
    ) {
        if (is_string($this->body) && strlen($this->body)) {
            $this->body = json_decode($this->body, true);

            if (!$this->body['success']) {
                $this->successRequest = false;
                $this->errorData = $this->body['error'];
            }
        } else {
            $this->successRequest = false;
            $this->errorData = [
                'code' => -2,
            ];
        }
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->successRequest;
    }
}