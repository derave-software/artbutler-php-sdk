<?php

namespace ArtbutlerPhpSdk\Queries\UserSettings;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\GeneralSettings;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetGeneralSettings
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $id, array $subSelections = []): Promise
    {
        $gql = (new Query('userSettings'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                empty($subSelections) ? GeneralSettings::getSubSelectionArray() : $subSelections
            );
        
        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
            return $response->getData();
        });
    }

}
