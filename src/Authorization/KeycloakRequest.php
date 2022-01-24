<?php

namespace ArtbutlerPhpSdk\Authorization;
use GuzzleHttp\Psr7\Response;

abstract class KeycloakRequest
{
    protected string $baseUrl;
    protected string $realm;
    protected string $clientId;
    protected string $clientSecret;

    protected Response $response;

    abstract protected function getUrl(): string;

    abstract protected function makeRequest(): Response;

    public function __construct()
    {

    }

    protected function getRealmUrl(): string
    {
        return $this->baseUrl . '/auth/admin/realms/' . $this->realm;
    }

    protected function getParams(): array
    {
        return [];
    }

    public function make(): Response
    {
        $response = $this->makeRequest();
        
        return $response;
    }


    protected function getHeaders(): array
    {
        return [];
    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}
