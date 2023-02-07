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
        $writer = new RequestWriter();
        fwrite($fp, $writer->header($request));

        if ($writer->hasData($request)) {
            fwrite($fp, $writer->data($request));
        }
    }

}