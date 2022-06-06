<?php

namespace ArtbutlerPhpSdk\Queries\AccountSettings;
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
        $gql = $this->getQuery($id, $subSelections);

        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
            return $response->getData();
        });
    }

    /**
     * @param  string  $id
     * @param  array  $subSelections
     *
     * @return Query
     */
    public function getQuery(string $id, array $subSelections): Query
    {
        return (new Query('accountSettings'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                empty($subSelections) ? GeneralSettings::getSubSelectionArray() : $subSelections
            );
    }

}
