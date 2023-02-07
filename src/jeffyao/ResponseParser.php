<?php

namespace jeffyao;

use jeffyao\exceptions\MalformedDataException;

/**
 * Simple response content parser.
 * Use this parser to transfer original response raw content into status code, headers and body.
 */
class ResponseParser
{

    /**
     * parse status code from original response raw content
     * @param string $content
     * @return int
     * @throws MalformedDataException
     */
    public function status(string $content): int
    {
        // we first get the first line. such as HTTP/1.1 401 Unauthorized
        $pos = strpos($content, "\n");
        if ($pos === false) {
            throw new MalformedDataException("Response invalid:" . $content);
        }

        //then we get status code in the middle.
        $firstLine = substr($content, 0, $pos);
        $lines = explode(' ', $firstLine);
        if (count($lines) < 3) {
            throw new MalformedDataException("Response invalid:" . $content);
        }
        return (int)$lines[1];
    }

    /**
     * parse headers from original response raw content
     * @param string $content
     * @return array
     * @throws MalformedDataException
     */
    public function headers(string $content): array
    {
        //first we just reserve the middle of the content. which is the headers part.
        $pos = strpos($content, "\n");
        if ($pos === false) {
            throw new MalformedDataException("Response invalid:" . $content);
        }

        $lastPos = strpos($content, "\n\n");
        if ($lastPos === false) {
            $lastPos = strlen($content);
        }

        $headers = substr($content, $pos + 1, $lastPos - $pos);
        $headers = explode("\n", $headers);

        $result = [];
        //for each line, we get name and value based on :
        foreach ($headers as $row) {
            if (empty(trim($row))) {
                continue;
            }
            $cells = explode(':', $row);
            if (count($cells) == 2) {
                $result[trim($cells[0])][] = trim($cells[1]);
            }

        }
        return $result;
    }

    /**
     * parse content from original response raw content
     * @param string $content
     * @return string
     */
    public function body(string $content): string
    {
        $pos = strpos($content, "\r\n\r\n");
        if ($pos === false) {
            return '';
        }

        return trim(substr($content, $pos));
    }

}