<?php
namespace ArtbutlerPhpSdk\Queries\Filters;

use ArtbutlerPhpSdk\GraphQLClient;
use GraphQL\Query;
use GraphQL\RawObject;
use GraphQL\Results;
use GuzzleHttp\Promise\Promise;

class GetFilterCollection
{
    public function __construct(protected GraphQLClient $apiClient)
    {
    }

    public function __invoke(string $type): Promise
    {
        $gql = (new Query('filterCollection'))
            ->setArguments(['type' => new RawObject($type)])
            ->setSelectionSet(
              [
                  'type',
                  (new Query('operators'))->setSelectionSet(
                      [
                          'value',
                          'description',
                      ]
                  )
              ]
            );

        return $this->apiClient->runQueryAsync($gql,true)->then(function(Results $response) {
                $data = $response->getData();
                
                return  $data;
            });
    }

}
