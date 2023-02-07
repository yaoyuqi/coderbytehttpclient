<?php

namespace jeffyao;

use jeffyao\exceptions\ConnectionException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class FSocketClient implements HttpClient
{

    /**
     * @param string $host
     * @param int $port
     * @return resource
     * @throws ConnectionException
     */
    private function createFP(string $host, int $port)
    {
        if ($port == 443) {
            $host = 'ssl://' . $host;
        }

        $fp = fsockopen($host, $port, $error, $errStr, 30);
        if (!$fp) {
            print_r($errStr . ' ' . $error);
            print_r("\n\n\n");
            throw new ConnectionException($errStr, $error);
        }
        return $fp;
    }

    /**
     * @throws ConnectionException
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri();
        $fp = $this->createFP($uri->getHost(), $uri->getPort());
        $this->writeRequest($fp, $request);
        $out = '';
        while (!feof($fp)) {
            $out .= fgets($fp, 128);
        }
        fclose($fp);

        return new SimpleResponse($out);
    }

    private function writeRequest($fp, RequestInterface $request)
    {
        $uri = $request->getUri();
        $out = sprintf("%s %s HTTP/1.1\r\n", strtoupper($request->getMethod()), $uri->getPath());
        $out .= sprintf("Host: %s\r\n", $uri->getHost());

        $headers = $request->getHeaders();

        foreach ($headers as $name => $values) {
            foreach ($values as $value) {
                $out .= sprintf("%s: %s", $name, $value);
            }
        }

        if ($request->getBody()->getSize() > 0) {
            $out .= sprintf("Content-Length: %s\r\n\r\n", $request->getBody()->getSize());
        }
        $out .= "Connection: Close\r\n\r\n";
        print_r($out);
        fwrite($fp, $out);

//        fwrite($fp, sprintf("%s %s HTTP/1.1\r\n", strtoupper($request->getMethod()), $uri->getPath()));
//        fwrite($fp, sprintf("Host: %s\r\n", $uri->getHost()));
//        if ($request->getMethod() == 'POST') {
//            fwrite($fp, "Content-Type: application/json\r\n");
//            fwrite($fp, sprintf("Content-Length: %s\r\n\r\n", $request->getBody()->getSize()));
//        }
////
////
//        fwrite($fp, "Connection: Close\r\n\r\n");
////        $data = "";
////        fwrite($fp, $data);
    }

}