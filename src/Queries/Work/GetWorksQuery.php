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
                    'filters' => $filters->createQueryArgument()
                ])
                ->setSelectionSet(
                    [
                        (new Query('data'))->setSelectionSet(
                           empty($subSelections) ? Work::getSubSelectionArray() : $subSelections
                        )
                    ]
                );



            return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
                $data = $response->getData();

                $worksDTOs = [];
                foreach ($data['works']['data'] as $key => $work)
                {
                    $worksDTOs[$key] = WorkDTO::createFromArray($work);
                }

                return $worksDTOs;
            });
    }

}
