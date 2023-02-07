<?php

namespace jeffyao;

use Psr\Http\Message\RequestInterface;

/**
 * Request data formatter.
 * Transfer RequestInterface to raw string context.
 */
class RequestWriter
{
    /**
     * Write the header part.
     * It ends with two line breaks.
     *
     * sample:
     * POST /assessment-endpoint.php HTTP/1.1
     * Authorization: Bearer 123123
     * Content-Type: application/json
     * User-Agent: PostmanRuntime/7.28.4
     *
     *
     * @param RequestInterface $request
     * @return string
     */
    public function header(RequestInterface $request): string
    {
        $uri = $request->getUri();
        $out = sprintf("%s %s HTTP/1.1\r\n", strtoupper($request->getMethod()), $uri->getPath());
        $out .= sprintf("Host: %s\r\n", $uri->getHost());

        $headers = $request->getHeaders();
        foreach ($headers as $name => $values) {
            foreach ($values as $value) {
                $out .= sprintf("%s: %s\r\n", $name, $value);
            }
        }

        if ($request->getBody()->getSize() > 0) {
            $out .= sprintf("Content-Length: %s\r\n", $request->getBody()->getSize());
        }
        $out .= "Connection: Close\r\n\r\n";

        print_r("**** request header:\n");
        print_r($out);
        print_r("\n");

        return $out;
    }

    /**
     * Check the request whether has form payload.
     * @param RequestInterface $request
     * @return bool
     */
    public function hasData(RequestInterface $request): bool
    {
        return $request->getBody()->getSize() > 0;
    }

    /**
     * Write the form payload part. otherwise, make it blank.
     * @param RequestInterface $request
     * @return string
     */
    public function data(RequestInterface $request): string
    {
        $data = '';
        if ($this->hasData($request)) {
            $data = $request->getBody() . "\r\n\r\n";
        }
        print_r("**** request payload:\n");
        print_r($data);
        print_r("\n");

        return $data;
    }

}