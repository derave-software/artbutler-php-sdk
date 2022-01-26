Example usage:
===============
```php
    $client = (new \ArtbutlerPhpSdk\Client(
    'GraphQL endpoint',
    'Keycloak endpoint',
    'realm',
    'clientId',
    'clientSecret',
    'publicKey',
    'tenantId'
    ));

    $workClient = (new \ArtbutlerPhpSdk\ModelClients\WorkClient($client));

    $work = $workClient->getWorks(20, 1, []);

    $works = $workClient->getWork('865dc13d-1cae-3ecb-94cd-8eb01de6b741');

    $promises = [
        'works'=>$works,
        'work' => $work
    ];

    $client->resolvePromises($promises);
```