<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\Repositories\Repository;
use ArtbutlerPhpSdk\Repositories\WorkRepository;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

abstract class ModelClient
{
    protected GraphQLClient $apiClient;

    abstract public function __construct(Client $client);


}
