<?php

namespace ArtbutlerPhpSdk\Authorization;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class GetAccesTokenRequest extends KeycloakRequest
{
    public function __construct(protected string $baseUrl, protected string $realm, protected string $clientId, protected string $clientSecret)
    {
    }

    protected function getRealmUrl(): string
    {
        return $this->baseUrl . '/auth/realms/' . $this->realm;
    }

    protected function getHeaders(): array
    {
        return array_merge(parent::getHeaders(), [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
    }

    protected function getParams(): array
    {
        return [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }

    protected function getUrl(): string
    {
        return $this->getRealmUrl() . '/protocol/openid-connect/token';
    }

    protected function makeRequest(): Response
    {
       $this->response = (new Client())
           ->post($this->getUrl(), [
               'form_params'=> $this->getParams()
           ]);

        return $this->response;
    }

    public function getTokenFromResponse(): string
    {
        $responseBody = json_decode($this->response->getBody()->getContents(), true);

        return (string)$responseBody['access_token'];
    }
}
