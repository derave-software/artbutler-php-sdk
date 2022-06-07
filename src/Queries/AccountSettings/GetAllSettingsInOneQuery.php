<?php

namespace ArtbutlerPhpSdk\Queries\AccountSettings;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\GeneralSettings;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Queries\Translation\GetTranslations;
use GraphQL\Query;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetAllSettingsInOneQuery
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $id, string $translationsGroup, array $subSelections = []): Promise
    {
        $gql = $this->getQuery($id, $translationsGroup, $subSelections);

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
    private function getQuery(string $id, string $translationsGroup, array $subSelections):  Query
    {
        $contentLanguages = (new GetContentLanguages($this->apiClient))->getQuery($id, []);
        $showroomSettings = (new GetShowroomSettings($this->apiClient))->getQuery($id, []);
        $generalSettings = (new GetGeneralSettings($this->apiClient))->getQuery($id, []);
        $translations = (new GetTranslations($this->apiClient))->getQuery($translationsGroup, []);

        return (new Query())->setSelectionSet([
            $contentLanguages,
            $showroomSettings,
            $generalSettings,
            $translations
        ]);
    }

}
