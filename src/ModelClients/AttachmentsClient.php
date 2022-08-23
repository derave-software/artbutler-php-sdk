<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use ArtbutlerPhpSdk\GraphQL\Page;
use ArtbutlerPhpSdk\GraphQL\Presentation;
use ArtbutlerPhpSdk\Queries\Attachments\GetDocuments;
use ArtbutlerPhpSdk\Queries\Attachments\GetImages;
use ArtbutlerPhpSdk\Queries\Page\GetPage;
use ArtbutlerPhpSdk\Queries\Presentation\GetPresentation;
use ArtbutlerPhpSdk\Queries\Showroom\GetShowrooms;
use ArtbutlerPhpSdk\Queries\Page\GetPages;
use GraphQL\Query;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class AttachmentsClient extends ModelClient
{
    public function getDocuments(array $categories = [], ?FiltersCollection $filters = null): Promise
    {
        return (new GetDocuments($this->apiClient))($categories, $filters);
    }

    public function getImages(array $categories = [], ?FiltersCollection $filters = null): Promise
    {
        return (new GetImages($this->apiClient))($categories, $filters);
    }
}
