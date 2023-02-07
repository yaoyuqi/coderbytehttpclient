<?php

namespace jeffyao;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Http Client Interface
 */
interface HttpClient
{
    public function handle(RequestInterface $request): ResponseInterface;
}