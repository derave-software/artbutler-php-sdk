<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\WorkDTO;

use ArtbutlerPhpSdk\Queries\AccountSettings\GetAllSettingsInOneQuery;
use ArtbutlerPhpSdk\Queries\AccountSettings\GetContentLanguages;
use ArtbutlerPhpSdk\Queries\AccountSettings\GetGeneralSettings;
use ArtbutlerPhpSdk\Queries\AccountSettings\GetShowroomSettings;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\Queries\Work\GetWorks;
use ArtbutlerPhpSdk\Queries\Work\GetWork;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class AccountSettingsClient extends ModelClient
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

    public function getGeneralSettings(?string $id = null): Promise
    {
        $id = $id ?? $this->getTenantId();
        return (new GetGeneralSettings($this->apiClient))($id);
    }

    public function getAllSettingsInOneQuery(?string $id = null): Promise
    {
        $id = $id ?? $this->getTenantId();
        
        return (new GetAllSettingsInOneQuery($this->apiClient))($id );
    }
    
    
}
