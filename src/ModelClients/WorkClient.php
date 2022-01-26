<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\WorkDTO;
use GraphQL\Client;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\Queries\Work\GetWorksQuery;
use ArtbutlerPhpSdk\Queries\Work\GetWorkQuery;
use ArtbutlerPhpSdk\GraphQLClient;

class WorkClient extends ModelClient
{
    public function __construct(protected \ArtbutlerPhpSdk\Client $client)
    {
        $this->apiClient = (new GraphQLClient($client));
    }

    /**
     * @param int $first
     * @param int $page
     * @param array $filters
     * @return Promise<[WorkDTO]>
     */
    public function getWorks(int $first, int $page, array $filters): Promise
    {
        return (new GetWorksQuery($this->apiClient))($first, $page, $filters);
    }

    /**
     * @param string $id
     * @return Promise<WorkDTO>
     */
    public function getWork(string $id): Promise
    {
        return (new GetWorkQuery($this->apiClient))($id);
    }
}
