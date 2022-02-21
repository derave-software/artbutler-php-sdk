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

class GetPages
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(int $first, int $page, array $subSelections = []): Promise
    {
        $gql = self::getQuery($first, $page, $subSelections);

        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
                return $response->getData();
            });
    }

    /**
     * @param  int  $first
     * @param  int  $page
     * @param  array  $subSelections
     *
     * @return Query
     */
    public static function getQuery(int $first, int $page, array $subSelections = []): Query
    {
        $gql = (new Query('pages'))
            ->setArguments([
                'first' => $first,
                'page'  => $page,
            ])
            ->setSelectionSet(
                [
                    (new Query('data'))->setSelectionSet(
                        empty($subSelections) ? Page::getSubSelectionArray() : $subSelections
                    )
                ]
            );

        return $gql;
    }

}
