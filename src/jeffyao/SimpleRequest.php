<?php

namespace jeffyao;

use jeffyao\exceptions\MalformedDataException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class SimpleRequest implements RequestInterface
{
    private $headers = [];
    private $body;
    private $method = 'GET';
    private $uri;

    /**
     * @throws MalformedDataException
     */
    public function __construct(string $url, string $method, array $headers, array $body)
    {
        $this->uri = new SimpleUri($url);
        $this->withMethod($method);
        foreach ($headers as $key => $val) {
            $this->headers[$key][] = $val;
        }
        $this->body = new SimpleBody($body);
    }


    public function getProtocolVersion()
    {
        return '1.1';
    }

    public function withProtocolVersion($version)
    {
        throw new \Exception("Not implemented");
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function hasHeader($name)
    {
        return isset($this->headers[$name]);
    }

    public function getHeader($name)
    {
        return $this->hasHeader($name) ? $this->headers[$name] : [];
    }

    public function getHeaderLine($name)
    {
        throw new \Exception("Not implemented");
    }

    public function withHeader($name, $value)
    {
        $this->headers[$name][] = $value;
    }

    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader($name)
    {
        if (isset($this->headers[$name])) {
            unset($this->headers[$name]);
        }
    }

    public function getBody()
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body)
    {
        $this->body = $body;
    }

    public function getRequestTarget()
    {
        throw new \Exception("Not implemented");
    }

    public function withRequestTarget($requestTarget)
    {
        throw new \Exception("Not implemented");
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function withMethod($method)
    {
        $this->method = strtoupper($method);
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        throw new \Exception("Not implemented");
    }
}