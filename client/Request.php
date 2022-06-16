<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class Request
{
    protected ?Client $client = null;

    public function request(
        string $method,
        string $uri,
        array $data = [],
        array $headers = [],
        $callback = null): void
    {
        $promise = $this->getClient()->requestAsync($method, $uri, [
            'body' => $data,
            'headers' => $headers,
        ]);

        $promise->then(
            fn(ResponseInterface $response) => $callback($response),
            function (RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        );
    }

    /**
     * @return Client
     */
    private function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = new Client();
        }

        return $this->client;
    }

    /**
    public function Info()
    {
        $res = $this->Request(array(
            'method' => 'info',
        ));

        return $res;
    }


    public function Orders($pair = 'BTC_USDT')
    {
        $res = $this->Request(array(
            'method' => 'orders',
            'post' => array(
                'pair' => $pair,
            ),
        ));

        return $res['pairs'];
    }


    public function Account()
    {
        $res = $this->Request(array(
            'method' => 'account',
        ));

        return $res['balances'];
    }


    public function OrderCreate($req = array())
    {
        $res = $this->Request(array(
            'method' => 'order_create',
            'post' => $req,
        ));

        return $res;
    }


    public function OrderStatus($req = array())
    {
        $res = $this->Request(array(
            'method' => 'order_status',
            'post' => $req,
        ));

        return $res['order'];
    }


    public function MyOrders($req = array())
    {
        $res = $this->Request(array(
            'method' => 'my_orders',
            'post' => $req,
        ));

        return $res['items'];
    }*/
}