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

class GetPage
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }


    public function __invoke(string $id, array $subSelections = []): Promise
    {
        $gql = self::getQuery($id, $subSelections);

        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
                return $response->getData();
            });
    }
    
    /**
     * @param  string  $id
     * @param  array  $subSelections
     *
     * @return Query
     */
    public static function getQuery(string $id, array $subSelections): Query
    {
        $gql = (new Query('page'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                empty($subSelections) ? Page::getSubSelectionArray() : $subSelections
            );

        return $gql;
    }




}