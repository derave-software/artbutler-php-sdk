<?php
namespace ArtbutlerPhpSdk\Authorization;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Auth
{
    private GetAccesTokenRequest $getAccesTokenRequest;
    public string $token;


    public function __construct(
        protected string $keycloakBaseUrl,
        protected string $realm,
        protected string $clientId,
        protected string $clientSecret,
        protected string $publicKey
    )
    {
        $this->getAccesTokenRequest = (new GetAccesTokenRequest(
            $this->keycloakBaseUrl,
            $this->realm,
            $this->clientId,
            $this->clientSecret
        ));
    }

    public function tokenIsValid()
    {
        try {
            JWT::decode($this->token, static::buildPublicKey($this->publicKey),['RS256']);
        } catch(\Firebase\JWT\ExpiredException $e){
            return false;
        } 
        
        return true;
    }

    private static function buildPublicKey(string $key)
    {
        return "-----BEGIN PUBLIC KEY-----\n" . wordwrap($key, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
    }

    public function getToken()
    {
        if(isset($this->token)){
            if(!$this->tokenIsValid()){
                $this->token = $this->getNewToken($this->token);
            }
        } else {
            $this->token = $this->getNewToken();
        }

        return $this->token;
    }

    public function getNewToken(){
        $this->getAccesTokenRequest->make();
        return $this->getAccesTokenRequest->getTokenFromResponse();
    }
}
