<?php
namespace ArtbutlerPhpSdk\Queries\Showroom;
use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\OrderDTO;
use ArtbutlerPhpSdk\DTOs\SearchDTO;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\GraphQL\Showroom;
use ArtbutlerPhpSdk\GraphQL\Work;
use GraphQL\Query;
use GraphQL\Results;
use GraphQL\Variable;
use GraphQL\RawObject;
use GuzzleHttp\Promise\Promise;
use GraphQL\QueryBuilder\QueryBuilder;

class GetShowrooms
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(
        int $first,
        int $page,
        ?FiltersCollection $filters = null,
        array $subSelections = [],
        ?SearchDTO $search = null,
        ?OrderDTO $order = null
    ): Promise
    {
        $gql = self::getQuery($first, $page, $filters, $subSelections, $search, $order);

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
    public static function getQuery(
        int $first,
        int $page,
        ?FiltersCollection $filters,
        array $subSelections,
        ?SearchDTO $search,
        ?OrderDTO $order
    ): Query
    {
        $arguments = [
            'first' => $first,
            'page'  => $page,
        ];

        if(!is_null($filters)) {
            $arguments = array_merge($arguments, ['filters' => $filters->createQueryArgument()]);
        }

        if(!is_null($search)) {
            $arguments = array_merge($arguments, ['search' => $search->createQueryArgument()]);
        }

        if(!is_null($order)) {
            $arguments = array_merge($arguments, ['order' => $order->createQueryArgument()]
            );
        }

        $gql = (new Query('showrooms'))
            ->setArguments($arguments)
            ->setSelectionSet(
                [
                    (new Query('data'))->setSelectionSet(
                        empty($subSelections) ? Showroom::getSubSelectionArray() : $subSelections
                    )
                ]
            );

        return $gql;
    }
}
