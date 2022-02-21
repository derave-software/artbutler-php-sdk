<?php
namespace ArtbutlerPhpSdk\Queries\Work;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetWork
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $id, array $subSelections = []): Promise
    {
        $gql = (new Query('work'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                empty($subSelections) ? Work::getSubSelectionArray() : $subSelection
            );

        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
                $data = $response->getData();
                return  WorkDTO::createFromArray($data['work']);
            });
    }

}
