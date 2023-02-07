<?php

namespace jeffyao;

use jeffyao\exceptions\MalformedDataException;
use jeffyao\exceptions\ResponseStatusError;
use Psr\Http\Message\ResponseInterface;

class HttpWrapper
{
    /**
     * @var HttpClient
     */
    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws MalformedDataException
     * @throws ResponseStatusError
     */
    public function options(string $url, array $headers): string
    {
        $request = new SimpleRequest($url, 'OPTIONS', $headers, []);
        $response = $this->client->handle($request);
        $this->statusCheck($response);

        return $response->getBody();
    }

    /**
     * @throws MalformedDataException
     * @throws ResponseStatusError
     */
    public function get(string $url, array $headers): string
    {
        $request = new SimpleRequest($url, 'GET', $headers, []);
        $response = $this->client->handle($request);
        $this->statusCheck($response);
        return $response->getBody();
    }

    /**
     * @throws MalformedDataException
     * @throws ResponseStatusError
     */
    public function post(string $url, string $token, array $headers, array $body)
    {
        $headers['Authorization'] = 'Bearer ' . $token;
        $headers['Content-Type'] = 'application/json';
        $request = new SimpleRequest($url, 'POST', $headers, $body);
        $response = $this->client->handle($request);
        $this->statusCheck($response);
        $body = $response->getBody();
        try {
            $body = json_decode($body);
        } catch (\JsonException $e) {
            throw new MalformedDataException("response data json decode error.", $e->getCode(), $e);
        }
        return $body;
    }

    /**
     * @throws ResponseStatusError
     */
    private function statusCheck(ResponseInterface $response)
    {
        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 600) {
            throw new ResponseStatusError("The response status code is " . $response->getStatusCode());
        }
    }


}