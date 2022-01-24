<?php
namespace ArtbutlerPhpSdk\Authorization;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Auth
{
    private GetAccesTokenRequest $getAccesTokenRequest;

    public function __construct(
        string $keycloakBaseUrl,
        string $realm,
        string $clientId,
        string $clientSecret
    )
    {
        $this->getAccesTokenRequest = (new GetAccesTokenRequest(
            $keycloakBaseUrl,
            $realm,
            $clientId,
            $clientSecret
        ));
    }

    public function getToken(){
        $this->getAccesTokenRequest->make();
        return $this->getAccesTokenRequest->getTokenFromResponse();
    }
}
