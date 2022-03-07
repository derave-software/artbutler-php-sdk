<?php
namespace ArtbutlerPhpSdk\Queries\Translation;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\GraphQL\Showroom;
use ArtbutlerPhpSdk\GraphQL\UserTranslations;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\RawObject;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetTranslations
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $group, array $subSelections = []): Promise
    {
        $gql = self::getQuery($group, $subSelections);

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
    public static function getQuery(string $group, array $subSelections): Query
    {

        $gql = (new Query('userTranslations'))
            ->setArguments(['group' => new RawObject($group)])
            ->setSelectionSet(
                empty($subSelections) ? UserTranslations::getSubSelectionArray() : $subSelections
            );

        return $gql;
    }
}
