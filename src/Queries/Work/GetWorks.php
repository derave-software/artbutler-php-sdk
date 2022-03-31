<?php
namespace ArtbutlerPhpSdk\Queries\Work;
use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\SearchDTO;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\RawObject;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetWorks
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(int $first, int $page, ?FiltersCollection $filters = null, array $subSelections = []): Promise
    {
        $gql = static::getQuery($first, $page, $subSelections, $filters);

        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
                return $this->resolveResponse($response);
            });
    }

    /**
     * @param Results $response
     * @return array<WorkDTO>
     */
    private function resolveResponse(Results $response): array
    {
        $data = $response->getData();

        $worksDTOs = [];
        foreach ($data['works']['data'] as $key => $work) {
            $worksDTOs[$key] = WorkDTO::createFromArray($work);
        }
        return $worksDTOs;
    }

    /**
     * @param  int  $first
     * @param  int  $page
     * @param  array  $subSelections
     * @param  FiltersCollection|null  $filters
     *
     * @return Query
     */
    public static function getQuery(int $first, int $page, array $subSelections, ?FiltersCollection $filters = null, ?SearchDTO $search = null): Query
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

        $gql = (new Query('works'))
            ->setArguments($arguments)
            ->setSelectionSet(
                [
                    (new Query('data'))->setSelectionSet(
                        empty($subSelections) ? Work::getSubSelectionArray() : $subSelections
                    )
                ]
            );


        return $gql;
    }

}
