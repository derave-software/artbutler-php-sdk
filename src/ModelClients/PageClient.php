<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use ArtbutlerPhpSdk\Queries\Page\GetPage;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\Queries\Page\GetPages;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class PageClient extends ModelClient
{
    public function __construct(protected Client $client)
    {
        $this->apiClient = (new GraphQLClient($client));
    }

    /**
     * @param int $first
     * @param int $page
     * @param array $filters
     * @return Promise<[WorkDTO]>
     */
    public function getPages(int $first, int $page): Promise
    {
        return (new GetPages($this->apiClient))($first, $page);
    }

    /**
     * @param string $id
     * @return Promise
     */
    public function getPage(string $id): Promise
    {
        return (new GetPage($this->apiClient))($id);
    }


}
