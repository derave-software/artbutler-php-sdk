<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use ArtbutlerPhpSdk\Queries\UserSettings\GetContentLanguages;
use ArtbutlerPhpSdk\Queries\UserSettings\GetShowroomSettings;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\Queries\Work\GetWorks;
use ArtbutlerPhpSdk\Queries\Work\GetWork;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class UserSettingsClient extends ModelClient
{

    public function getContentLanguages(?string $id = null): Promise
    {
        $id = $id ?? $this->getTenantId();
        return (new GetContentLanguages($this->apiClient))($id);
    }

    public function getShowroomSettings(?string $id = null): Promise
    {
        $id = $id ?? $this->getTenantId();
        return (new GetShowroomSettings($this->apiClient))($id);
    }
}
