<?php
namespace ArtbutlerPhpSdk;
use ArtbutlerPhpSdk\Repositories\WorkRepository;

class WorkClient extends ModelClient
{
    public function __construct(Client $client) {
         $this->repository = (new WorkRepository(
            $client->gqlEndpoint,
            $client->getToken(),
            $client->tenantId,
        ));
    }

    public function getWorks(int $first, int $page, array $filters)
    {
        return $this->repository->getWorks(
            $first,
            $page,
            \ArtbutlerPhpSdk\GraphQL\Work::getSubSelectionArray(),
            $filters
        );
    }

    public function getWork(string $id)
    {
        return $this->repository->getWork(
            $id,
            \ArtbutlerPhpSdk\GraphQL\Work::getSubSelectionArray()
        );
    }

}
