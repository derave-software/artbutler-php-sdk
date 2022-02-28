<?php
namespace ArtbutlerPhpSdk\Queries\Documents;
use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\GraphQL\Showroom;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQL\Attachment;

class GetDocuments
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(?FiltersCollection $filters = null, array $subSelections = []): Promise
    {
        $gql = self::getQuery($filters, $subSelections);

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
    public static function getQuery(?FiltersCollection $filters, array $subSelections): Query
    {
        $gql = (new Query('documents'))
            ->setArguments(['filters' => $filters->createQueryArgument()])
            ->setSelectionSet(
                empty($subSelections) ? Attachment::getSubSelectionArray() : $subSelections
            );
  
        return $gql;
    }
}
