<?php
namespace ArtbutlerPhpSdk\Queries\Work;
use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\RawObject;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetWorksQuery
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(int $first, int $page, ?FiltersCollection $filters = null, array $subSelections = []): Promise
    {
            $gql = (new Query('works'))
                ->setArguments([
                    'first' => $first,
                    'page' => $page,
                ])
                ->setSelectionSet(
                    [
                        (new Query('data'))->setSelectionSet(
                           empty($subSelections) ? Work::getSubSelectionArray() : $subSelections
                        )
                    ]
                );

                if(!is_null($filters)) {
                    $gql->setArguments([
                        'filters' => $filters->createQueryArgument()
                    ]);
                }

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

}
