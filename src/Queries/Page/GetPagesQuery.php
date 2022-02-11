<?php
namespace ArtbutlerPhpSdk\Queries\Page;
use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\Page;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\RawObject;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQL\Blocks\ArtistsList;

class GetPagesQuery
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(int $first, int $page, array $subSelections = []): Promise
    {
            $gql = (new Query('pages'))
                ->setArguments([
                    'first' => $first,
                    'page' => $page,
                ])
                ->setSelectionSet(
                    [
                        (new Query('data'))->setSelectionSet(
                           empty($subSelections) ? Page::getSubSelectionArray() : $subSelections
                        )
                    ]
                );
        
            return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
                return $response->getData();
            });
    }

}
