<?php

namespace ArtbutlerPhpSdk\Queries\UserSettings;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\Shared\ContentLanguages;
use ArtbutlerPhpSdk\GraphQL\ShowroomSettings;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetShowroomSettings
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $id, array $subSelections = []): Promise
    {
        $gql = (new Query('showroomsSettings'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                empty($subSelections) ? ShowroomSettings::getSubSelectionArray() : $subSelections
            );
        
        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
            return $response->getData();
        });
    }

}
