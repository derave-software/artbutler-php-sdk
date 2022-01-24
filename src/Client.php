<?php

namespace ArtbutlerPhpSdk;

use ArtbutlerPhpSdk\Authorization\Auth;

class Client
{
    public function __construct(
        private string $gqlEndpoint,
        private string $keycloakBaseUrl,
        private string $realm,
        private string $clientId,
        private string $clientSecret,
        private string $tenantId
    )
    {
    }

    protected function getToken(){
        return (new Auth(
            $this->keycloakBaseUrl,
            $this->realm,
            $this->clientId,
            $this->clientSecret
        ))->getToken();
    }

    public function getWorks(int $first, int $page, array $filters)
    {
        return (new \ArtbutlerPhpSdk\Repositories\WorkRepository(
            $this->gqlEndpoint,
            $this->getToken(),
            $this->tenantId,
        ))->getWorks($first, $page, $filters);
    }

    public function getWork(string $id)
    {
        return (new \ArtbutlerPhpSdk\Repositories\WorkRepository(
            $this->gqlEndpoint,
            $this->getToken(),
            $this->tenantId,
        ))->getWork($id);
    }

}
