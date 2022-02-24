<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use ArtbutlerPhpSdk\GraphQL\Page;
use ArtbutlerPhpSdk\GraphQL\Presentation;
use ArtbutlerPhpSdk\Queries\Page\GetPage;
use ArtbutlerPhpSdk\Queries\Presentation\GetPresentation;
use ArtbutlerPhpSdk\Queries\Documents\GetDocuments;
use ArtbutlerPhpSdk\Queries\Showroom\GetShowrooms;
use ArtbutlerPhpSdk\Queries\Page\GetPages;
use GraphQL\Query;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class DocumentsClient extends ModelClient
{
    public function getDocuments(?FiltersCollection $filters = null): Promise
    {
        return (new GetDocuments($this->apiClient))($filters);
    }
}
