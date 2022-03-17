<?php

namespace ArtbutlerPhpSdk;

use ArtbutlerPhpSdk\Authorization\Auth;
use Firebase\JWT\JWT;

class Client
{
    private Auth $auth;
    protected string $tenant = '';
    
    public function __construct(
        public string $gqlEndpoint,
        private string $keycloakBaseUrl,
        private string $realm,
        private string $clientId,
        private string $clientSecret,
        private string $publicKey,
    )
    {
        $this->auth = (new Auth(
            $this->keycloakBaseUrl,
            $this->realm,
            $this->clientId,
            $this->clientSecret,
            $this->publicKey
        ));
    }

    public function setTenant(string $tenant): static
    {
        $this->tenant = $tenant;
        
        return $this;
    }

    public function getTenant(): string
    {
        return $this->tenant;
    }

    public function getToken(): string
    {
        return $this->auth->getToken();
    }

    public function resolvePromises(array $promises): array
    {
        return \GuzzleHttp\Promise\Utils::unwrap($promises);
    }


}
