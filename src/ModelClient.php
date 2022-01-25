<?php
namespace ArtbutlerPhpSdk;
use ArtbutlerPhpSdk\Repositories\Repository;
use ArtbutlerPhpSdk\Repositories\WorkRepository;

abstract class ModelClient
{
    protected Repository $repository;

    abstract public function __construct(Client $client);
}
