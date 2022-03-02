<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use ArtbutlerPhpSdk\GraphQL\Page;
use ArtbutlerPhpSdk\GraphQL\Presentation;
use ArtbutlerPhpSdk\Queries\Page\GetPage;
use ArtbutlerPhpSdk\Queries\Translation\GetTranslations;
use ArtbutlerPhpSdk\Queries\Documents\GetDocuments;
use ArtbutlerPhpSdk\Queries\Showroom\GetShowrooms;
use ArtbutlerPhpSdk\Queries\Page\GetPages;
use GraphQL\Query;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class TranslationClient extends ModelClient
{
    public function getTranslations(string $group): Promise
    {
        return (new GetTranslations($this->apiClient))($group, []);
    }
}
