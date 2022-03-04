<?php

namespace ArtbutlerPhpSdk\Queries\UserSettings;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\Shared\ContentLanguages;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetContentLanguages
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $id, array $subSelections = []): Promise
    {
        $gql = (new Query('contentLanguagesSettings'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                empty($subSelections) ? ContentLanguages::getSubSelectionArray() : $subSelection
            );
        
        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
            return $response->getData();
        });
    }

}
