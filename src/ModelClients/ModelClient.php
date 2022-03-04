<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\Repositories\Repository;
use ArtbutlerPhpSdk\Repositories\WorkRepository;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;
use Illuminate\Support\Arr;

abstract class ModelClient
{
    protected GraphQLClient $apiClient;

    public function __construct(protected Client $client)
    {
        $this->apiClient = (new GraphQLClient($client));
    }

    public function resolvePromises(array|Promise $promises): array
    {
        $promises = Arr::wrap($promises);
        return $this->client->resolvePromises($promises);
    }

    public function getTenantId(): string
    {
        return $this->client->tenantId;
    }


}
