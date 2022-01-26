<?php

namespace ArtbutlerPhpSdk;

use ArtbutlerPhpSdk\Authorization\Auth;

class Client
{
    protected string $token;

    public function __construct(
        public string $gqlEndpoint,
        private string $keycloakBaseUrl,
        private string $realm,
        private string $clientId,
        private string $clientSecret,
        public string $tenantId
    )
    {
        $this->auth = (new Auth(
            $this->keycloakBaseUrl,
            $this->realm,
            $this->clientId,
            $this->clientSecret
        ));
    }

    public function getToken()
    {
        if(isset($this->token)){
            if($this->tokenIsValid()){
                return $this->token;
            } else {
                $this->token = $this->refreshToken($this->token);
                return $this->token;
            }
        } else {
            $this->token = $this->getTokenFromKeycloak();
            return $this->token;
        }
    }

    public function tokenIsValid()
    {

        return $this->auth->getToken();
    }

    public function getTokenFromKeycloak()
    {
        return $this->auth->getToken();
    }

    public function refreshToken()
    {
        return $this->auth->refreshToken();
    }

}
