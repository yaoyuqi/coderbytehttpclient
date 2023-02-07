<?php

namespace jeffyao;

use Psr\Http\Message\ResponseInterface;

class FSocketClient implements HttpClient
{
    /**
     * @var string hostname
     */
    private $host;

    /**
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host = $host;
    }


    public function get(string $url, ?array $headers, array $params): ResponseInterface
    {
        // TODO: Implement get() method.
    }

    public function post(string $url, ?array $headers, array $params): ResponseInterface
    {
        // TODO: Implement post() method.
    }

    public function option(string $url, ?array $headers): ResponseInterface
    {
        // TODO: Implement option() method.
    }
}