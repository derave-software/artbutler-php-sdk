<?php

namespace ArtbutlerPhpSdk\Repositories;

use ArtbutlerPhpSdk\GraphQlApiClient;
use ArtbutlerPhpSdk\GraphQL\Work;
use GuzzleHttp\Client;


class WorkRepository
{
    protected GraphQlApiClient $apiClient;

    public function __construct(){
        $this->apiClient = (new GraphQlApiClient());
    }

    public function getAll()
    {
        $token = $this->apiClient->getToken();

       return $response = $this->apiClient->post([
           'query' =>Work::getQuery()
       ], $token)->getContent();
    }
}
