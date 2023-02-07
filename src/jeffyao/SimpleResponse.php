<?php

namespace jeffyao;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Simple implementation of ResponseInterface
 * Just implemented the needed part.
 */
class SimpleResponse implements ResponseInterface
{
    /**
     * original raw content
     * @var string
     */
    private $content;

    /**
     * statusCode
     * @var int
     */
    private $status;
    /**
     * body
     * @var SimpleBody
     */
    private $body;

    /**
     * headers
     * @var array
     */
    private $headers;

    /**
     * Receive the raw response content.
     * Tranfer it into status, headers, and so on.
     * A better way is to make ResponseParser parser as an param,
     * then we can use DI to make it more flexible.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
        $parser = new ResponseParser();
        $this->status = $parser->status($content);
        $this->body = new SimpleBody($parser->body($content));
        $this->headers = $parser->headers($content);

        print_r("---------original response:\n");
        print_r($content . "\n\n");

        print_r("*********Response parsed: $this->status -headers: \n");
        foreach ($this->headers as $name => $values) {
            foreach ($values as $value) {
                print_r($name . " =>" . $value . "\n");
            }
        }

        print_r("\n");
        print_r("*********Response body: \n");
        echo $this->body;
        print_r("\n");
    }


    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
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
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    public function getBody()
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }

    public function getStatusCode()
    {
        return $this->status;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        // TODO: Implement withStatus() method.
    }

    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
    }

    public function __toString()
    {
        return $this->content;
    }


}