<?php

namespace jeffyao\exceptions;

/**
 * Data invalid.
 * Including request data and response data.
 * No matter in which part, headers or in the process of json encode/decode,
 * if there are errors, throw this exception.
 */
class MalformedDataException extends \Exception
{

}