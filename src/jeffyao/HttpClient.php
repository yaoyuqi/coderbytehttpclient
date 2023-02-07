<?php

namespace jeffyao;

use Psr\Http\Message\ResponseInterface;

/**
 * Http Client Interface
 */
interface HttpClient
{

    public function get(string $url, ?array $headers, array $params) : ResponseInterface;
    public function post(string $url,  ?array $headers, array $params) : ResponseInterface;
    public function option(string $url,  ?array $headers) : ResponseInterface;
}