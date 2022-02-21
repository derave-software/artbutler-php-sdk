<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use ArtbutlerPhpSdk\GraphQL\Page;
use ArtbutlerPhpSdk\GraphQL\Presentation;
use ArtbutlerPhpSdk\Queries\Page\GetPage;
use ArtbutlerPhpSdk\Queries\Presentation\GetPresentation;
use ArtbutlerPhpSdk\Queries\Page\GetPages;
use GraphQL\Query;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class PresentationClient extends ModelClient
{
    public function __construct(protected Client $client)
    {
        $this->apiClient = (new GraphQLClient($client));
    }

    /**
     * @param int $id
     * @return Promise
     */
    public function getPresentation(string $id): Promise
    {
        return (new GetPresentation($this->apiClient))($id);
    }

    /**
     * @param int $first pages pagination
     * @param int $page pages pagination
     * @return Promise
     */
    public function getPresentationWithPages(
        string $id,
    ): Promise
    {
        $subSelections = [
            ...Presentation::getSubSelectionArray(),
            (new Query('pages'))
                ->setSelectionSet(
                     Page::getSubSelectionArray()
                )
        ];
        
        return (new GetPresentation($this->apiClient))($id, $subSelections);
    }
}
