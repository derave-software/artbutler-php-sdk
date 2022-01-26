<?php
namespace ArtbutlerPhpSdk\ModelClients;
use ArtbutlerPhpSdk\Repositories\Repository;
use ArtbutlerPhpSdk\Repositories\WorkRepository;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQLClient;

abstract class ModelClient
{
    protected GraphQLClient $apiClient;

    abstract public function __construct(\ArtbutlerPhpSdk\Client $client);
    
    
}
 