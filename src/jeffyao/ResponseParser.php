<?php

namespace jeffyao;

use jeffyao\exceptions\MalformedDataException;

class ResponseParser
{

    public function status(string $content): int
    {
        $pos = strpos($content, "\n");
        if ($pos === false) {
            throw new MalformedDataException("Response invalid:" . $content);
        }

        $firstLine = substr($content, 0, $pos);
        $lines = explode(' ', $firstLine);
        if (count($lines) < 3) {
            throw new MalformedDataException("Response invalid:" . $content);
        }
        return (int)$lines[1];
    }

    public function headers(string $content): array
    {
        $pos = strpos($content, "\n");
        if ($pos === false) {
            throw new MalformedDataException("Response invalid:" . $content);
        }

        $lastPos = strpos($content, "\n\n");
        if ($lastPos === false) {
            $lastPos = strlen($content);
        }

        $headers = substr($content, $pos, $lastPos - $pos);
        $headers = explode("\n", $headers);

        $result = [];
        foreach ($headers as $row) {
            if (empty(trim($row))) {
                continue;
            }
            $cells = explode(':', $row);
            if (count($cells) < 2) {
                throw new MalformedDataException("Response invalid:" . $content);
            }
            $result[trim($cells[0])][] = trim($cells[1]);
        }
        return $result;
    }

    public function body(string $content): string
    {
        $pos = strpos($content, "\n\n");
        if ($pos === false) {
            return '';
        }

        return trim(substr($content, $pos));
    }

}