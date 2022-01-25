<?php

namespace ArtbutlerPhpSdk\Repositories;

use GraphQL\Client;

abstract class Repository
{
    protected Client $apiClient;

    abstract protected function createDTOFromArray(array $data);

    public function __construct(string $endpoint, string $token, string $tenantId)
    {
        $this->apiClient = (new Client(
            $endpoint,
            [],
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Tenant' => $tenantId
                ],
            ]
        ));
    }


}
