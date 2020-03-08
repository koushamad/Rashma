---
title: API Reference

language_tabs:
- bash
- javascript
- php
- python

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://165.22.108.175:8000/docs/collection.json)

<!-- END_INFO -->

#Auth


<!-- START_021c800ce78a747f764d20007e07c41a -->
## Get Code

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/auth/getCode" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"phone":"velit"}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/auth/getCode"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "phone": "velit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/auth/getCode',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'phone' => 'velit',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/auth/getCode'
payload = {
    "phone": "velit"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/auth/getCode`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `phone` | string |  required  | 
    
<!-- END_021c800ce78a747f764d20007e07c41a -->

<!-- START_85b43b973b32fe6d31605841d9baf0c7 -->
## Get Token

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/auth/getToken" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"phone":"ipsam","code":12}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/auth/getToken"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "phone": "ipsam",
    "code": 12
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/auth/getToken',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'phone' => 'ipsam',
            'code' => 12,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/auth/getToken'
payload = {
    "phone": "ipsam",
    "code": 12
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/auth/getToken`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `phone` | string |  required  | 
        `code` | integer |  required  | 
    
<!-- END_85b43b973b32fe6d31605841d9baf0c7 -->

<!-- START_8d5139efe6dfe1a42ae27e5cfb45b7e7 -->
## Refresh Token

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/auth/refreshToken" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"token":"asperiores","refreshToken":"delectus"}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/auth/refreshToken"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "token": "asperiores",
    "refreshToken": "delectus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/auth/refreshToken',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'token' => 'asperiores',
            'refreshToken' => 'delectus',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/auth/refreshToken'
payload = {
    "token": "asperiores",
    "refreshToken": "delectus"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/auth/refreshToken`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | 
        `refreshToken` | string |  required  | 
    
<!-- END_8d5139efe6dfe1a42ae27e5cfb45b7e7 -->

<!-- START_dfb6508344215b26ec55cebf032139bc -->
## Update Request

> Example request:

```bash
curl -X PATCH \
    "http://165.22.108.175:8000/api/v1/user/updateRequest" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"email":"officia","phone":"praesentium"}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/user/updateRequest"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "officia",
    "phone": "praesentium"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://165.22.108.175:8000/api/v1/user/updateRequest',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'email' => 'officia',
            'phone' => 'praesentium',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/user/updateRequest'
payload = {
    "email": "officia",
    "phone": "praesentium"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`PATCH api/v1/user/updateRequest`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | 
        `phone` | string |  required  | 
    
<!-- END_dfb6508344215b26ec55cebf032139bc -->

<!-- START_97d7f1b270fafc9755c122ebbdec8a09 -->
## Update Accept

> Example request:

```bash
curl -X PATCH \
    "http://165.22.108.175:8000/api/v1/user/updateAccept" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"code":"assumenda"}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/user/updateAccept"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "code": "assumenda"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://165.22.108.175:8000/api/v1/user/updateAccept',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'code' => 'assumenda',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/user/updateAccept'
payload = {
    "code": "assumenda"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`PATCH api/v1/user/updateAccept`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `code` | string |  required  | 
    
<!-- END_97d7f1b270fafc9755c122ebbdec8a09 -->

#Category


<!-- START_a57f11dcd3be6532bf32f2319f86413b -->
## Search Category

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/category/search/quo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/category/search/quo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/category/search/quo',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/category/search/quo'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/category/search/{text}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `text` |  required  | string

<!-- END_a57f11dcd3be6532bf32f2319f86413b -->

#Company


<!-- START_8bc7da8303ee184dc2f72e931990574a -->
## Search Company

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/company/search/laboriosam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/company/search/laboriosam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/company/search/laboriosam',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/company/search/laboriosam'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/company/search/{text}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `text` |  required  | string

<!-- END_8bc7da8303ee184dc2f72e931990574a -->

#Experience


<!-- START_014d874e305163b654d82e47f7d4e09c -->
## Create Experience

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/experience" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"title":"ad","grade":13,"startDate":"ullam","endDate":"optio","company":[]}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/experience"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "title": "ad",
    "grade": 13,
    "startDate": "ullam",
    "endDate": "optio",
    "company": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/experience',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'title' => 'ad',
            'grade' => 13,
            'startDate' => 'ullam',
            'endDate' => 'optio',
            'company' => [],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/experience'
payload = {
    "title": "ad",
    "grade": 13,
    "startDate": "ullam",
    "endDate": "optio",
    "company": []
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/experience`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | 
        `grade` | integer |  required  | 
        `startDate` | date |  required  | 
        `endDate` | date |  optional  | 
        `company` | array |  required  | [id => int, name => string]
    
<!-- END_014d874e305163b654d82e47f7d4e09c -->

<!-- START_c4b54be73d65555df223bcf4c732ef4d -->
## Update Experience

> Example request:

```bash
curl -X PATCH \
    "http://165.22.108.175:8000/api/v1/experience/libero" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"title":"nam","grade":3,"startDate":"voluptatem","endDate":"officia","company":[]}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/experience/libero"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "title": "nam",
    "grade": 3,
    "startDate": "voluptatem",
    "endDate": "officia",
    "company": []
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://165.22.108.175:8000/api/v1/experience/libero',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'title' => 'nam',
            'grade' => 3,
            'startDate' => 'voluptatem',
            'endDate' => 'officia',
            'company' => [],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/experience/libero'
payload = {
    "title": "nam",
    "grade": 3,
    "startDate": "voluptatem",
    "endDate": "officia",
    "company": []
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`PATCH api/v1/experience/{experienceId}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `experienceId` |  required  | int
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | 
        `grade` | integer |  required  | 
        `startDate` | date |  required  | 
        `endDate` | date |  optional  | 
        `company` | array |  required  | [id => int, name => string]
    
<!-- END_c4b54be73d65555df223bcf4c732ef4d -->

<!-- START_3e97f9575b1174251d4c3145c332bf2f -->
## Delete Experience

> Example request:

```bash
curl -X DELETE \
    "http://165.22.108.175:8000/api/v1/experience/voluptates" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/experience/voluptates"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://165.22.108.175:8000/api/v1/experience/voluptates',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/experience/voluptates'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```



### HTTP Request
`DELETE api/v1/experience/{experienceId}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `experienceId` |  required  | int

<!-- END_3e97f9575b1174251d4c3145c332bf2f -->

#Licence


<!-- START_bb4e8f063e65247881b2061651d1a915 -->
## Create Licence

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/licence" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"title":"velit","grade":20,"startDate":"ea","endDate":"placeat","university":[]}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/licence"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "title": "velit",
    "grade": 20,
    "startDate": "ea",
    "endDate": "placeat",
    "university": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/licence',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'title' => 'velit',
            'grade' => 20,
            'startDate' => 'ea',
            'endDate' => 'placeat',
            'university' => [],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/licence'
payload = {
    "title": "velit",
    "grade": 20,
    "startDate": "ea",
    "endDate": "placeat",
    "university": []
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/licence`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | 
        `grade` | integer |  required  | 
        `startDate` | date |  required  | 
        `endDate` | date |  optional  | 
        `university` | array |  required  | [id => int, name => string]
    
<!-- END_bb4e8f063e65247881b2061651d1a915 -->

<!-- START_f5de0b6ec7595c7c5f139841d4a0e647 -->
## Update Licence

> Example request:

```bash
curl -X PATCH \
    "http://165.22.108.175:8000/api/v1/licence/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"title":"rerum","grade":9,"startDate":"sint","endDate":"id","university":[]}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/licence/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "title": "rerum",
    "grade": 9,
    "startDate": "sint",
    "endDate": "id",
    "university": []
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://165.22.108.175:8000/api/v1/licence/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'title' => 'rerum',
            'grade' => 9,
            'startDate' => 'sint',
            'endDate' => 'id',
            'university' => [],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/licence/1'
payload = {
    "title": "rerum",
    "grade": 9,
    "startDate": "sint",
    "endDate": "id",
    "university": []
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`PATCH api/v1/licence/{experienceId}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `licenceId` |  required  | int
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | 
        `grade` | integer |  required  | 
        `startDate` | date |  required  | 
        `endDate` | date |  optional  | 
        `university` | array |  required  | [id => int, name => string]
    
<!-- END_f5de0b6ec7595c7c5f139841d4a0e647 -->

<!-- START_dff0bc0e967c8f089a5d4f0b307bc6ec -->
## Delete Licence

> Example request:

```bash
curl -X DELETE \
    "http://165.22.108.175:8000/api/v1/licence/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/licence/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://165.22.108.175:8000/api/v1/licence/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/licence/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```



### HTTP Request
`DELETE api/v1/licence/{experienceId}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `licenceId` |  required  | int

<!-- END_dff0bc0e967c8f089a5d4f0b307bc6ec -->

#Profile


<!-- START_5c7b37bc0e37355d0513e20909d9061f -->
## Get Profile Enums

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/enums" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/enums"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/enums',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/enums'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/enums`


<!-- END_5c7b37bc0e37355d0513e20909d9061f -->

<!-- START_cd0df6f69b0247f994a6ccfe27afb1a7 -->
## Get Profile

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/profile',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/profile'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/profile`


<!-- END_cd0df6f69b0247f994a6ccfe27afb1a7 -->

<!-- START_dde76cc85fb2cc34aa6ac545d206e957 -->
## Update Profile

> Example request:

```bash
curl -X PATCH \
    "http://165.22.108.175:8000/api/v1/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"fullName":"aspernatur","nationalCode":"sint","cardNumber":"veniam","skills":[],"categories":[]}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "fullName": "aspernatur",
    "nationalCode": "sint",
    "cardNumber": "veniam",
    "skills": [],
    "categories": []
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://165.22.108.175:8000/api/v1/profile',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'fullName' => 'aspernatur',
            'nationalCode' => 'sint',
            'cardNumber' => 'veniam',
            'skills' => [],
            'categories' => [],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/profile'
payload = {
    "fullName": "aspernatur",
    "nationalCode": "sint",
    "cardNumber": "veniam",
    "skills": [],
    "categories": []
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`PATCH api/v1/profile`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `fullName` | string |  optional  | 
        `nationalCode` | string |  optional  | 
        `cardNumber` | string |  optional  | 
        `skills` | array |  optional  | 
        `categories` | array |  optional  | 
    
<!-- END_dde76cc85fb2cc34aa6ac545d206e957 -->

#Quiz


<!-- START_22be60f43c318d8da03a69c3d3d50fda -->
## Get Quiz

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/quiz/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/quiz/aut"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/quiz/aut',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/quiz/aut'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/quiz/{quizId}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `quizId` |  required  | string

<!-- END_22be60f43c318d8da03a69c3d3d50fda -->

<!-- START_b75b40cb3a8d837dfdd7f5b7dfadc54d -->
## Create Quiz

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/quiz" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"title":"aut","description":"similique","grade":"ipsum","isEmergency":true,"skills":[],"categories":[]}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/quiz"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "title": "aut",
    "description": "similique",
    "grade": "ipsum",
    "isEmergency": true,
    "skills": [],
    "categories": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/quiz',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'title' => 'aut',
            'description' => 'similique',
            'grade' => 'ipsum',
            'isEmergency' => true,
            'skills' => [],
            'categories' => [],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/quiz'
payload = {
    "title": "aut",
    "description": "similique",
    "grade": "ipsum",
    "isEmergency": true,
    "skills": [],
    "categories": []
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/quiz`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  optional  | 
        `description` | string |  optional  | 
        `grade` | string |  optional  | 
        `isEmergency` | boolean |  optional  | 
        `skills` | array |  optional  | [id , name , id ]
        `categories` | array |  optional  | [id , name , id ]
    
<!-- END_b75b40cb3a8d837dfdd7f5b7dfadc54d -->

<!-- START_2f8612c7a5ab58244e2792767aeae78b -->
## Pay Quiz

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/payQuiz/molestias" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/payQuiz/molestias"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/payQuiz/molestias',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/payQuiz/molestias'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/payQuiz/{quizId}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `quizId` |  required  | string

<!-- END_2f8612c7a5ab58244e2792767aeae78b -->

#Setting


<!-- START_547f21fab32cbb0d6b3eeab9f82be0cb -->
## Get Setting

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/setting" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/setting"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/setting',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/setting'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/setting`


<!-- END_547f21fab32cbb0d6b3eeab9f82be0cb -->

<!-- START_4c24cbb9674c271a6454875b95f2a9ee -->
## Update Setting

> Example request:

```bash
curl -X PATCH \
    "http://165.22.108.175:8000/api/v1/setting" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"lang":8,"isNotify":true,"isPublic":true}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/setting"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "lang": 8,
    "isNotify": true,
    "isPublic": true
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://165.22.108.175:8000/api/v1/setting',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'lang' => 8,
            'isNotify' => true,
            'isPublic' => true,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/setting'
payload = {
    "lang": 8,
    "isNotify": true,
    "isPublic": true
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`PATCH api/v1/setting`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `lang` | integer |  optional  | 
        `isNotify` | boolean |  optional  | 
        `isPublic` | boolean |  optional  | 
    
<!-- END_4c24cbb9674c271a6454875b95f2a9ee -->

#Skill


<!-- START_b1162a07cc40726f7a2155119486cb10 -->
## Search Skill

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/skill/search/laboriosam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/skill/search/laboriosam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/skill/search/laboriosam',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/skill/search/laboriosam'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/skill/search/{text}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `text` |  required  | string

<!-- END_b1162a07cc40726f7a2155119486cb10 -->

#Test


<!-- START_0bef4e738c9d6720ad43b062015d1078 -->
## api/test
> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/test"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/test',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/test'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/test`


<!-- END_0bef4e738c9d6720ad43b062015d1078 -->

#Transaction


<!-- START_f656fe06f0bb7bdfa9a86003b0873fc7 -->
## Cash In

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/transaction/cashIn" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"cash":457825.089379927}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/transaction/cashIn"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "cash": 457825.089379927
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/transaction/cashIn',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'cash' => 457825.089379927,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/transaction/cashIn'
payload = {
    "cash": 457825.089379927
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/transaction/cashIn`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `cash` | float |  required  | 
    
<!-- END_f656fe06f0bb7bdfa9a86003b0873fc7 -->

<!-- START_043e0e83f5f63644780f6a234a071bba -->
## Cash Out Approve

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/transaction/cashOut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"cash":2571.39}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/transaction/cashOut"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "cash": 2571.39
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/transaction/cashOut',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'cash' => 2571.39,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/transaction/cashOut'
payload = {
    "cash": 2571.39
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/transaction/cashOut`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `cash` | float |  required  | 
    
<!-- END_043e0e83f5f63644780f6a234a071bba -->

<!-- START_bbfd9e3b83cf61b5141178e5e7ce776a -->
## Cash Out Approve

> Example request:

```bash
curl -X POST \
    "http://165.22.108.175:8000/api/v1/transaction/cashOutApprove" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"code":"velit"}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/transaction/cashOutApprove"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "code": "velit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://165.22.108.175:8000/api/v1/transaction/cashOutApprove',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'code' => 'velit',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/transaction/cashOutApprove'
payload = {
    "code": "velit"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`POST api/v1/transaction/cashOutApprove`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `code` | string |  required  | 
    
<!-- END_bbfd9e3b83cf61b5141178e5e7ce776a -->

#University


<!-- START_a1e596f32ddbb2700cc8fc7a5857586e -->
## Search University

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/university/search/quia" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/university/search/quia"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/university/search/quia',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/university/search/quia'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/university/search/{text}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `text` |  required  | string

<!-- END_a1e596f32ddbb2700cc8fc7a5857586e -->

#Wallet


<!-- START_0f19c59bad3f90db68986ce2ad86a836 -->
## Get Statistics

> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/v1/wallet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/wallet"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/v1/wallet',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/wallet'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/v1/wallet`


<!-- END_0f19c59bad3f90db68986ce2ad86a836 -->

#general


<!-- START_33ab8a9c71b5076d513d5effd2f5e0d5 -->
## Attach Image to profile

> Example request:

```bash
curl -X PATCH \
    "http://165.22.108.175:8000/api/v1/profile/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"imageId":"culpa"}'

```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/profile/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "imageId": "culpa"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://165.22.108.175:8000/api/v1/profile/image',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'imageId' => 'culpa',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/profile/image'
payload = {
    "imageId": "culpa"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()
```



### HTTP Request
`PATCH api/v1/profile/image`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `imageId` | string |  optional  | 
    
<!-- END_33ab8a9c71b5076d513d5effd2f5e0d5 -->

<!-- START_a2816176194c8e2862c1984c611ee247 -->
## Detach Image to profile

> Example request:

```bash
curl -X DELETE \
    "http://165.22.108.175:8000/api/v1/profile/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/v1/profile/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://165.22.108.175:8000/api/v1/profile/image',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/v1/profile/image'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```



### HTTP Request
`DELETE api/v1/profile/image`


<!-- END_a2816176194c8e2862c1984c611ee247 -->

<!-- START_e3f4f84ff6aae499993aea33dad87c24 -->
## api/{fallbackPlaceholder}
> Example request:

```bash
curl -X GET \
    -G "http://165.22.108.175:8000/api/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://165.22.108.175:8000/api/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://165.22.108.175:8000/api/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://165.22.108.175:8000/api/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/{fallbackPlaceholder}`


<!-- END_e3f4f84ff6aae499993aea33dad87c24 -->


