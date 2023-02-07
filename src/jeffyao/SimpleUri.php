<?php

namespace jeffyao;

use jeffyao\exceptions\MalformedDataException;
use Psr\Http\Message\UriInterface;

class SimpleUri implements UriInterface
{
    private $schema;
    private $host;
    private $path;
    private $query;

    /**
     * @param $uri
     * @throws MalformedDataException
     */
    public function __construct($uri)
    {
        //parse schema
        $parts = explode(':', $uri);

        if (empty($parts)
            || (
                strtolower($parts[0]) !== 'http'
                && strtolower($parts[0]) !== 'https')
        ) {
            throw new MalformedDataException("URI schema invalid");
        }

        $this->schema = strtolower($parts[0]);

        //parse host
        $left = substr($uri, strlen($parts[0]) + 3);

        $parts = explode('/', $left);
        if (empty($parts)) {
            throw new MalformedDataException("URI host invalid");
        }
        $this->host = $parts[0];

        //parse path
        $left = substr($left, strlen($parts[0]) + 1);
        $parts = explode('?', $left);
        $this->path = empty($parts[0]) ? '/' : $parts[0];

        //parse query
        $this->query = empty($parts[1]) ? '' : $parts[1];
    }


    public function getScheme()
    {
        return $this->schema;
    }

    public function getAuthority()
    {
        // TODO: Implement getAuthority() method.
    }

    public function getUserInfo()
    {
        // TODO: Implement getUserInfo() method.
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        return $this->schema == 'http' ? 80 : 443;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getFragment()
    {
        // TODO: Implement getFragment() method.
    }

    public function withScheme($scheme)
    {
        // TODO: Implement withScheme() method.
    }

    public function withUserInfo($user, $password = null)
    {
        // TODO: Implement withUserInfo() method.
    }

    public function withHost($host)
    {
        // TODO: Implement withHost() method.
    }

    public function withPort($port)
    {
        // TODO: Implement withPort() method.
    }

    public function withPath($path)
    {
        // TODO: Implement withPath() method.
    }

    public function withQuery($query)
    {
        // TODO: Implement withQuery() method.
    }

    public function withFragment($fragment)
    {
        // TODO: Implement withFragment() method.
    }

    public function __toString()
    {
        return sprintf("%s://%s%s", $this->schema, $this->host, $this->path);
    }
}