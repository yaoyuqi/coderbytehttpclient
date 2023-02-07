<?php

use jeffyao\FSocketClient;
use jeffyao\HttpWrapper;
use jeffyao\RequestWriter;
use jeffyao\ResponseParser;
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
$content = <<<OEF
HTTP/1.1 200 OK
Date: Tue, 07 Feb 2023 09:00:29 GMT
Cache-Control: no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type: text/plain;charset=UTF-8
Set-Cookie: SPSI=518d16be5ae61be10917d2bd6ecbb2e6; path=/; HttpOnly; SameSite=Lax;
Set-Cookie: SPSE=dKcsVDisZydxbxcY1oVlKUs2Qp0naWEYklSerzIASKOpB/yPlqfVVeeBiSgPvOKKMRtGf47PoT8O2E7gYHREmQ==; path=/; HttpOnly; SameSite=Lax;
Vary: User-Agent
Device: Desktop
X-XSS-Protection: 0
X-Backend-Server: ip-172-24-4-81.ec2.internal
Server: fbs
X-HW: 1675760428.cds220.la3.hn,1675760428.cds256.la3.sc,1675760429.cdn2-redis01-lax1.stackpath.systems.-.wx,1675760429.cds256.la3.p
Access-Control-Allow-Origin: *
Connection: close
Content-Length: 36

d417fcbc-94b7-4357-aff3-536c33364428
OEF;
$simpleResponse = new SimpleResponse(
    $content
);
assert($simpleResponse == $content);
echo "----test $testName finished\n";


/**
 * Request Package writer test
 */
$testName = 'RequestWriter';
echo "----begin test $testName\n";
$writer = new RequestWriter();
$simpleRequest = new SimpleRequest(
    'https://corednacom.corewebdna.com/assessment-endpoint.php?xxx=1&ddd=2',
    'POST',
    ['Authorization' => 'Bearer 123'],
    ['param' => 1]
);

$body = $writer->data($simpleRequest);
assert(json_encode(['param' => 1]) == trim($body));

echo "----test $testName finished\n";

/*
 * Parse Response
 */
$testName = 'ResponseParser';
echo "----begin test $testName\n";

$content = <<<OEF
HTTP/1.1 200 OK
Date: Tue, 07 Feb 2023 09:00:29 GMT
Cache-Control: no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type: text/plain;charset=UTF-8
Set-Cookie: SPSI=518d16be5ae61be10917d2bd6ecbb2e6; path=/; HttpOnly; SameSite=Lax;
Set-Cookie: SPSE=dKcsVDisZydxbxcY1oVlKUs2Qp0naWEYklSerzIASKOpB/yPlqfVVeeBiSgPvOKKMRtGf47PoT8O2E7gYHREmQ==; path=/; HttpOnly; SameSite=Lax;
Vary: User-Agent
Device: Desktop
X-XSS-Protection: 0
X-Backend-Server: ip-172-24-4-81.ec2.internal
Server: fbs
X-HW: 1675760428.cds220.la3.hn,1675760428.cds256.la3.sc,1675760429.cdn2-redis01-lax1.stackpath.systems.-.wx,1675760429.cds256.la3.p
Access-Control-Allow-Origin: *
Connection: close
Content-Length: 36

d417fcbc-94b7-4357-aff3-536c33364428
OEF;
$parser = new ResponseParser();
assert($parser->status($content) == 200);
assert("d417fcbc-94b7-4357-aff3-536c33364428" == $parser->body($content));
assert(count($parser->headers($content)) == 13);
echo "----test $testName finished\n";

/*
 * Connection test
 */
$testName = 'Connection';
echo "----begin test $testName\n";
$client = new FSocketClient();

$url = "https://corednacom.corewebdna.com/assessment-endpoint.php";
$request = new SimpleRequest($url, 'OPTIONS', [], []);
$response = $client->handle($request);
assert(!empty($response->getBody()));
echo "----test $testName finished\n";


echo "\n\n\n\n";
echo "from here, we begin real test\n";
echo "first, we let options to get token. \n";
/*
 * OPTIONS Test
 */
$client = new HttpWrapper(new FSocketClient());
$url = "https://corednacom.corewebdna.com/assessment-endpoint.php";
$token = $client->options($url, ['Customer-header' => "123"]);

$token = $response->getBody();
echo "\n\n";
print_r("token is:" . $token . "\n");

/*
 * POST Test
 */
echo "\n\n";
echo "second, we post our information. \n";
$body = $client->post(
    $url,
    $token,
    ['Customer-header2' => "0000"],
    [
        "name" => 'this is name',
        "email" => 'this is email',
        "url" => 'this is url'
    ]
);

echo "\n\n";
echo "the response is: \n";
print_r($body);

echo "\n\n All tests finished.";

