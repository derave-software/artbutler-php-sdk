<?php

namespace ArtbutlerPhpSdk;

use ArtbutlerPhpSdk\Authorization\Auth;

class Client
{
    public function __construct(
        public string $gqlEndpoint,
        private string $keycloakBaseUrl,
        private string $realm,
        private string $clientId,
        private string $clientSecret,
        public string $tenantId
    )
    {
    }

    public function getToken(){
        return (new Auth(
            $this->keycloakBaseUrl,
            $this->realm,
            $this->clientId,
            $this->clientSecret
        ))->getToken();
    }

}
