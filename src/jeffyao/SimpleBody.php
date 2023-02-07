<?php

namespace jeffyao;

use jeffyao\exceptions\MalformedDataException;
use Psr\Http\Message\StreamInterface;

class SimpleBody implements StreamInterface
{
    private $bodyStr = '';

    /**
     * @param array|string $body
     * @throws MalformedDataException
     */
    public function __construct($body)
    {
        if (is_array($body) && !empty($body)) {
            try {
                $this->bodyStr = json_encode($body);
            } catch (\JsonException $e) {
                throw new MalformedDataException("Json encode error.", $e->getCode(), $e);
            }
        } else {
            $this->bodyStr = $body;
        }
    }


    public function __toString()
    {
        return $this->bodyStr;
    }

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function detach()
    {
        // TODO: Implement detach() method.
    }

    public function getSize()
    {
        return strlen($this->bodyStr);
    }

    public function tell()
    {
        // TODO: Implement tell() method.
    }

    public function eof()
    {
        // TODO: Implement eof() method.
    }

    public function isSeekable()
    {
        // TODO: Implement isSeekable() method.
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Implement seek() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function isWritable()
    {
        // TODO: Implement isWritable() method.
    }

    public function write($string)
    {
        // TODO: Implement write() method.
    }

    public function isReadable()
    {
        // TODO: Implement isReadable() method.
    }

    public function read($length)
    {
        // TODO: Implement read() method.
    }

    public function getContents()
    {
        // TODO: Implement getContents() method.
    }

    public function getMetadata($key = null)
    {
        // TODO: Implement getMetadata() method.
    }
}