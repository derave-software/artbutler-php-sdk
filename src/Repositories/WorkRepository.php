<?php

namespace ArtbutlerPhpSdk\Repositories;

use ArtbutlerPhpSdk\Authorization\Auth;
use ArtbutlerPhpSdk\GraphQlApiClient;
use ArtbutlerPhpSdk\GraphQL\Work;
use GraphQL\Client;
use GraphQL\Query;


class WorkRepository
{
    protected Client $apiClient;

    public function __construct(string $endpoint, string $token, string $tenantId)
    {
        $this->apiClient = (new Client(
            'http://app/graphql',
            [],
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Tenant' => $tenantId
                ],
            ]
        ));

    }

    public function getWorks(int $first, int $page)
    {

        $gql = (new Query('works'))
            ->setArguments(['first' => $first, 'page' => $page])
            ->setSelectionSet(
                [
                    (new Query('data'))->setSelectionSet(
                        Work::getSubSelectionArray()
                    )
                ]
            );

        $response = $this->apiClient->runQuery($gql);

        return $response->getData();
    }

    public function getWork(string $id)
    {
        $gql = (new Query('work'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                Work::getSubSelectionArray()
            );

        $response = $this->apiClient->runQuery($gql);

        return $response->getData();
    }
}
