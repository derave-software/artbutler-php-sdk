<?php
namespace ArtbutlerPhpSdk\Queries\Presentation;
use ArtbutlerPhpSdk\GraphQL\Presentation;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetPresentation
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $id, array $subSelections = []): Promise
    {
        $gql = self::getQuery($id, $subSelections);

        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
            return  $response->getData();
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
        $gql = (new Query('presentation'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                empty($subSelections) ? Presentation::getSubSelectionArray() : $subSelections
            );
  

        return $gql;
    }
}
