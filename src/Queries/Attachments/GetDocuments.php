<?php
namespace ArtbutlerPhpSdk\Queries\Attachments;
use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\GraphQL\Showroom;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\RawObject;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\GraphQL\Attachment;

class GetDocuments
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(array $categories = [], ?FiltersCollection $filters = null, array $subSelections = []): Promise
    {
        $gql = self::getQuery($categories, $filters, $subSelections);

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
    public static function getQuery(array $categories, ?FiltersCollection $filters, array $subSelections): Query
    {
        $arguments = [];

        $gql = (new Query('documents'))
            ->setSelectionSet(
                empty($subSelections) ? Attachment::getSubSelectionArray() : $subSelections
            );

        if(!empty($categories)) {
            foreach ($categories as $key => $value) {
                $categories[$key] =  new RawObject($value);
            }
            $arguments = array_merge($arguments,['categories' => $categories]);
        }


        if(!is_null($filters)) {
            $arguments = array_merge($arguments, ['filters' => $filters->createQueryArgument()]);
        }

        $gql->setArguments($arguments);

        return $gql;
    }
}
