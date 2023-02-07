##### A simple Http Client.

Use HttpWrapper to make http request, such as post, get, options.

It can easily add delete, put methods.

##### Run

```
php src/Test.php
```

##### Log snapshot:

```
[www@iZp0w6f9qn3xoiz3b3aikbZ coderbytehttpclient]$ php src/Test.php
----begin test SimpleUri
----test SimpleUri finished
----begin test SimpleBody
----test SimpleBody finished
----begin test SimpleRequest
----test SimpleRequest finished
----begin test SimpleResponse
---------original response:
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

*********Response parsed: 200 -headers:
Cache-Control =>no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type =>text/plain;charset=UTF-8
Set-Cookie =>SPSI=518d16be5ae61be10917d2bd6ecbb2e6; path=/; HttpOnly; SameSite=Lax;
Set-Cookie =>SPSE=dKcsVDisZydxbxcY1oVlKUs2Qp0naWEYklSerzIASKOpB/yPlqfVVeeBiSgPvOKKMRtGf47PoT8O2E7gYHREmQ==; path=/; HttpOnly; SameSite=Lax;
Vary =>User-Agent
Device =>Desktop
X-XSS-Protection =>0
X-Backend-Server =>ip-172-24-4-81.ec2.internal
Server =>fbs
X-HW =>1675760428.cds220.la3.hn,1675760428.cds256.la3.sc,1675760429.cdn2-redis01-lax1.stackpath.systems.-.wx,1675760429.cds256.la3.p
Access-Control-Allow-Origin =>*
Connection =>close
Content-Length =>36

*********Response body:

----test SimpleResponse finished
----begin test RequestWriter
**** request payload:
{"param":1}


----test RequestWriter finished
----begin test ResponseParser
----test ResponseParser finished
----begin test Connection
**** request header:
OPTIONS /assessment-endpoint.php HTTP/1.1
Host: corednacom.corewebdna.com
Connection: Close


---------original response:
HTTP/1.1 200 OK
Date: Tue, 07 Feb 2023 11:29:34 GMT
Cache-Control: no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type: text/plain;charset=UTF-8
Set-Cookie: SPSI=699b7775948776c6bcdd93881f4697a5; path=/; HttpOnly; SameSite=Lax;
Set-Cookie: SPSE=LFVkh1lZrFiUbodRyOGfOk9S3mLuuP/y1TjAAhR3pGMNIccGFPmD5plcPZPfoPpiCmqb7Y0JO+EvH7EAMBG4UA==; path=/; HttpOnly; SameSite=Lax;
Vary: User-Agent
Device: Desktop
X-XSS-Protection: 0
X-Backend-Server: ip-172-24-3-120.ec2.internal
Server: fbs
X-HW: 1675769374.cds207.sj3.hn,1675769374.cds219.sj3.sc,1675769374.cdn2-wafbe02-sjc1.stackpath.systems.-.wx,1675769374.cds219.sj3.p
Access-Control-Allow-Origin: *
x-sp-metadata: HS256.CK6IiZ8GEowBCiQzM2RkZGZjOS05YjMzLTQ4ODAtOWZkZi1hNTY0NTgzMzcyOTAQ+KbWqKWh9gIaBgie7IifBiIMNDcuOTEuNDcuMTkwKNLJAjACOANCG0VDREhFLVJTQS1BRVMxMjgtR0NNLVNIQTI1NlogMWNmY2VmNjY2ZDc3MzI3MjE3N2RmN2E5ZDEyNmM2ZTEaKBIkNWU2OWI0ZjMtN2M2Mi00NDlmLTllYzgtMjA4NDk0NDlkOTk0GCQiGggCEhRjZHMyMTkuc2ozLmh3Y2RuLm5ldBgI.9hqKFoIwyz10tnaA2WlK8ZPMLSt9x4M4WPjhOLdDZtg=
Connection: close
Content-Length: 36

d417fcbc-94b7-4357-aff3-536c33364428

*********Response parsed: 200 -headers:
Cache-Control =>no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type =>text/plain;charset=UTF-8
Set-Cookie =>SPSI=699b7775948776c6bcdd93881f4697a5; path=/; HttpOnly; SameSite=Lax;
Set-Cookie =>SPSE=LFVkh1lZrFiUbodRyOGfOk9S3mLuuP/y1TjAAhR3pGMNIccGFPmD5plcPZPfoPpiCmqb7Y0JO+EvH7EAMBG4UA==; path=/; HttpOnly; SameSite=Lax;
Vary =>User-Agent
Device =>Desktop
X-XSS-Protection =>0
X-Backend-Server =>ip-172-24-3-120.ec2.internal
Server =>fbs
X-HW =>1675769374.cds207.sj3.hn,1675769374.cds219.sj3.sc,1675769374.cdn2-wafbe02-sjc1.stackpath.systems.-.wx,1675769374.cds219.sj3.p
Access-Control-Allow-Origin =>*
x-sp-metadata =>HS256.CK6IiZ8GEowBCiQzM2RkZGZjOS05YjMzLTQ4ODAtOWZkZi1hNTY0NTgzMzcyOTAQ+KbWqKWh9gIaBgie7IifBiIMNDcuOTEuNDcuMTkwKNLJAjACOANCG0VDREhFLVJTQS1BRVMxMjgtR0NNLVNIQTI1NlogMWNmY2VmNjY2ZDc3MzI3MjE3N2RmN2E5ZDEyNmM2ZTEaKBIkNWU2OWI0ZjMtN2M2Mi00NDlmLTllYzgtMjA4NDk0NDlkOTk0GCQiGggCEhRjZHMyMTkuc2ozLmh3Y2RuLm5ldBgI.9hqKFoIwyz10tnaA2WlK8ZPMLSt9x4M4WPjhOLdDZtg=
Connection =>close
Content-Length =>36

*********Response body:
d417fcbc-94b7-4357-aff3-536c33364428
----test Connection finished




***********************************
*****from here, we begin real test
*****first, we let options to get token.
**** request header:
OPTIONS /assessment-endpoint.php HTTP/1.1
Host: corednacom.corewebdna.com
Customer-header: 123
Connection: Close


---------original response:
HTTP/1.1 200 OK
Date: Tue, 07 Feb 2023 11:29:35 GMT
Cache-Control: no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type: text/plain;charset=UTF-8
Set-Cookie: SPSI=ef3f6c2a70d79eb9e5a9d85881aca641; path=/; HttpOnly; SameSite=Lax;
Set-Cookie: SPSE=Z+KJAWYRITdlcDDTayiPssvqh6h8wJbo/ykNq9/M+qGFW9ax07+y3DEhLkQjMViNYyIh0aKfsfboUloPA0Q6Mg==; path=/; HttpOnly; SameSite=Lax;
Vary: User-Agent
Device: Desktop
X-XSS-Protection: 0
X-Backend-Server: ip-172-24-4-172.ec2.internal
Server: fbs
X-HW: 1675769375.cds033.la3.hn,1675769375.cds003.la3.sc,1675769375.cdn2-redis01-lax1.stackpath.systems.-.wx,1675769375.cds003.la3.p
Access-Control-Allow-Origin: *
Connection: close
Content-Length: 36

d417fcbc-94b7-4357-aff3-536c33364428

*********Response parsed: 200 -headers:
Cache-Control =>no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type =>text/plain;charset=UTF-8
Set-Cookie =>SPSI=ef3f6c2a70d79eb9e5a9d85881aca641; path=/; HttpOnly; SameSite=Lax;
Set-Cookie =>SPSE=Z+KJAWYRITdlcDDTayiPssvqh6h8wJbo/ykNq9/M+qGFW9ax07+y3DEhLkQjMViNYyIh0aKfsfboUloPA0Q6Mg==; path=/; HttpOnly; SameSite=Lax;
Vary =>User-Agent
Device =>Desktop
X-XSS-Protection =>0
X-Backend-Server =>ip-172-24-4-172.ec2.internal
Server =>fbs
X-HW =>1675769375.cds033.la3.hn,1675769375.cds003.la3.sc,1675769375.cdn2-redis01-lax1.stackpath.systems.-.wx,1675769375.cds003.la3.p
Access-Control-Allow-Origin =>*
Connection =>close
Content-Length =>36

*********Response body:
d417fcbc-94b7-4357-aff3-536c33364428


token is:d417fcbc-94b7-4357-aff3-536c33364428


*****second, we post our information.
**** request header:
POST /assessment-endpoint.php HTTP/1.1
Host: corednacom.corewebdna.com
Customer-header2: 0000
Authorization: Bearer d417fcbc-94b7-4357-aff3-536c33364428
Content-Type: application/json
Content-Length: 109
Connection: Close


**** request payload:
{"name":"Jeff Yao","email":"jeffyao028@gmail.com","url":"https:\/\/github.com\/yaoyuqi\/coderbytehttpclient"}


---------original response:
HTTP/1.1 202 Accepted
Date: Tue, 07 Feb 2023 11:29:37 GMT
Cache-Control: no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type: text/html; charset=UTF-8
Set-Cookie: SPSI=be1d8d60c3d8fc65a031605c27f2ef3e; path=/; HttpOnly; SameSite=Lax;
Set-Cookie: SPSE=1+Vh8SjUiHlFpJQKZO49OWcXeqqKdhImLUaTrbKfVdXMy/SdEsKr5FLhq1vc6DgyZquMUjIBloPVHA+TPTVWBw==; path=/; HttpOnly; SameSite=Lax;
Vary: User-Agent
Device: Desktop
Server: fbs
X-HW: 1675769375.cds201.sj3.hn,1675769376.cds008.sj3.sc,1675769377.cdn2-wafbe02-sjc1.stackpath.systems.-.wx,1675769377.cds008.sj3.p
Access-Control-Allow-Origin: *
x-sp-metadata: HS256.CLGIiZ8GEowBCiQzOWVlMWYyMS1lNjRhLTRmMjMtYmViZS04NzZmM2MyMDNhNjQQ+KbWqKWh9gIaBgif7IifBiIMNDcuOTEuNDcuMTkwKOLJAjACOANCG0VDREhFLVJTQS1BRVMxMjgtR0NNLVNIQTI1NlogMWNmY2VmNjY2ZDc3MzI3MjE3N2RmN2E5ZDEyNmM2ZTEaJhIkNDY2MzhiZmMtMjFiMS00YTFhLTljZmEtYWQzZTAwNTBjYjMzIhoIAhIUY2RzMDA4LnNqMy5od2Nkbi5uZXQYCA==.KBRl2c6dVQXrT8Yzw2OCvxJGKyCLScqZeyYXX8cktwk=
Connection: close
Content-Length: 0



*********Response parsed: 202 -headers:
Cache-Control =>no-store, no-cache, max-age=0, must-revalidate, private,  max-stale=0, post-check=0, pre-check=0
Content-Type =>text/html; charset=UTF-8
Set-Cookie =>SPSI=be1d8d60c3d8fc65a031605c27f2ef3e; path=/; HttpOnly; SameSite=Lax;
Set-Cookie =>SPSE=1+Vh8SjUiHlFpJQKZO49OWcXeqqKdhImLUaTrbKfVdXMy/SdEsKr5FLhq1vc6DgyZquMUjIBloPVHA+TPTVWBw==; path=/; HttpOnly; SameSite=Lax;
Vary =>User-Agent
Device =>Desktop
Server =>fbs
X-HW =>1675769375.cds201.sj3.hn,1675769376.cds008.sj3.sc,1675769377.cdn2-wafbe02-sjc1.stackpath.systems.-.wx,1675769377.cds008.sj3.p
Access-Control-Allow-Origin =>*
x-sp-metadata =>HS256.CLGIiZ8GEowBCiQzOWVlMWYyMS1lNjRhLTRmMjMtYmViZS04NzZmM2MyMDNhNjQQ+KbWqKWh9gIaBgif7IifBiIMNDcuOTEuNDcuMTkwKOLJAjACOANCG0VDREhFLVJTQS1BRVMxMjgtR0NNLVNIQTI1NlogMWNmY2VmNjY2ZDc3MzI3MjE3N2RmN2E5ZDEyNmM2ZTEaJhIkNDY2MzhiZmMtMjFiMS00YTFhLTljZmEtYWQzZTAwNTBjYjMzIhoIAhIUY2RzMDA4LnNqMy5od2Nkbi5uZXQYCA==.KBRl2c6dVQXrT8Yzw2OCvxJGKyCLScqZeyYXX8cktwk=
Connection =>close
Content-Length =>0

*********Response body:



*****the response is:


 All tests finished.[www@iZp0w6f9qn3xoiz3b3aikbZ coderbytehttpclient]$

```
