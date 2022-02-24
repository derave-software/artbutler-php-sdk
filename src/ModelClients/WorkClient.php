<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\Queries\Work\GetWorks;
use ArtbutlerPhpSdk\Queries\Work\GetWork;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class WorkClient extends ModelClient
{
       /**
     * @param int $first
     * @param int $page
     * @param array $filters
     * @return Promise<[WorkDTO]>
     */
    public function getWorks(int $first, int $page, ?FiltersCollection $filters = null): Promise
    {
        return (new GetWorks($this->apiClient))($first, $page, $filters);
    }

    /**
     * @param string $id
     * @return Promise<WorkDTO>
     */
    public function getWork(string $id): Promise
    {
        return (new GetWork($this->apiClient))($id);
    }
}
