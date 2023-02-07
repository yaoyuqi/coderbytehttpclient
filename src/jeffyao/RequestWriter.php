<?php

namespace jeffyao;

use Psr\Http\Message\RequestInterface;

class RequestWriter
{
    public function header(RequestInterface $request): string
    {
        $uri = $request->getUri();
        $out = sprintf("%s %s HTTP/1.1\r\n", strtoupper($request->getMethod()), $uri->getPath());
        $out .= sprintf("Host: %s\r\n", $uri->getHost());

        $headers = $request->getHeaders();
        print_r($headers);

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

    public function hasData(RequestInterface $request): bool
    {
        return $request->getBody()->getSize() > 0;
    }

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