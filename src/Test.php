<?php

use jeffyao\FSocketClient;
use jeffyao\SimpleBody;
use jeffyao\SimpleRequest;
use jeffyao\SimpleResponse;
use jeffyao\SimpleUri;

require __DIR__ . '/../vendor/autoload.php';

/*
 * SimpleUri Test
 */
$testName = 'SimpleUri';
echo "----begin test $testName\n";
$url = 'https://corednacom.corewebdna.com/assessment-endpoint.php?xxx=1&ddd=2';
$simpleUri = new SimpleUri($url);
assert($simpleUri->getScheme() == 'https');
assert($simpleUri->getHost() == 'corednacom.corewebdna.com');
assert($simpleUri->getPath() == '/assessment-endpoint.php');
assert($simpleUri->getQuery() == 'xxx=1&ddd=2');
echo "----test $testName finished\n";


/*
 * Simple Body Test
 */
$testName = 'SimpleBody';
echo "----begin test $testName\n";
$body = [
    'a' => '123',
    'b' => 1
];
$simpleBody = new SimpleBody($body);
assert($simpleBody == json_encode($body));
assert($simpleBody->getSize() == strlen(json_encode($body)));
echo "----test $testName finished\n";

/*
 * Simple Request Test
 */
$testName = 'SimpleRequest';
echo "----begin test $testName\n";
$simpleRequest = new SimpleRequest(
    'https://corednacom.corewebdna.com/assessment-endpoint.php?xxx=1&ddd=2',
    'POST',
    ['Authorization' => 'Bearer 123'],
    ['param' => 1]
);
assert($simpleRequest->getMethod() == 'POST');
assert($simpleRequest->getHeader('Authorization') == ['Bearer 123']);
assert($simpleRequest->getBody(), json_encode(['param' => 1]));
assert($simpleRequest->getUri()->getHost() == 'corednacom.corewebdna.com');
echo "----test $testName finished\n";

/*
 * Simple Response Test
 */
$testName = 'SimpleResponse';
echo "----begin test $testName\n";
$simpleResponse = new SimpleResponse(
    'this is content'
);
assert($simpleResponse == 'this is content');
echo "----test $testName finished\n";

/*
 * Get test
 */
$client = new FSocketClient();

$url = "https://corednacom.corewebdna.com/assessment-endpoint.php";
//$url = "https://www.baidu.com/";
$request = new SimpleRequest($url, 'OPTIONS', [], []);
$response = $client->handle($request);
print_r($response);
