<?php

namespace ArtbutlerPhpSdk\Repositories;

use ArtbutlerPhpSdk\Authorization\Auth;
use ArtbutlerPhpSdk\GraphQlApiClient;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use GraphQL\Client;
use GraphQL\Query;


class WorkRepository extends Repository
{
    public function getWorks(int $first, int $page, array $subselection, array $filters = [])
    {
        $gql = (new Query('works'))
            ->setArguments(['first' => $first, 'page' => $page])
            ->setSelectionSet(
                [
                    (new Query('data'))->setSelectionSet(
                        $subselection
                    )
                ]
            );

        $response = $this->apiClient->runQuery($gql,true);
        $data = $response->getData();

        $worksDTOs = [];
        foreach ($data['works']['data'] as $key => $work)
        {
            $worksDTOs[$key] = $this->createDTOFromArray($work);
        }

        return $worksDTOs;
    }

    public function getWork(string $id, array $subselection)
    {
        $gql = (new Query('work'))
            ->setArguments(['id' => $id])
            ->setSelectionSet(
                $subselection
            );

        $response = $this->apiClient->runQuery($gql, true);
        $data = $response->getData();

        return $this->createDTOFromArray($data['work']);
    }

    protected function createDTOFromArray(array $data)
    {
        return new WorkDTO(
            isset($data['id']) ? $data['id'] : null,
            isset($data['inventory_id']) ? $data['inventory_id'] : null,
            isset($data['draft']) ? $data['draft'] : [],
            isset($data['human_readable_id']) ? $data['human_readable_id'] : [],
            isset($data['status']) ? $data['status'] : null,
            isset($data['location']) ? $data['location'] : null,
            isset($data['type']) ? $data['type'] : null,
            isset($data['technique']) ? $data['technique'] : null,
            isset($data['main_image']) ? $data['main_image'] : null,
            isset($data['title']) ? $data['title'] : [],
            isset($data['description']) ? $data['description'] : [],
            isset($data['comment']) ? $data['comment'] : [],
            isset($data['edition']) ? $data['edition'] : [],
            isset($data['signature']) ? $data['signature'] : [],
            isset($data['provenance']) ? $data['provenance'] : [],
            isset($data['literature']) ? $data['literature'] : [],
            isset($data['exhibitions']) ? $data['exhibitions'] : [],
            isset($data['dimensions_description']) ? $data['dimensions_description'] : [],
            isset($data['year']) ? $data['year'] : [],
            isset($data['video_url']) ? $data['video_url'] : null,
            isset($data['owner']) ? $data['owner'] : null,
            isset($data['stock_holder']) ? $data['stock_holder'] : null,
            isset($data['work_size']) ? $data['work_size'] : [],
            isset($data['frame_size']) ? $data['frame_size'] : [],
            isset($data['transport_size']) ? $data['transport_size'] : [],
            isset($data['plate_size']) ? $data['plate_size'] : [],
            isset($data['plinth_size']) ? $data['plinth_size'] : [],
            isset($data['vitrine_size']) ? $data['vitrine_size'] : [],
            isset($data['tags']) ? $data['tags'] : [],
            isset($data['images']) ? $data['images'] : [],
            isset($data['created_at']) ? $data['created_at'] : [],
            isset($data['prices']) ? $data['prices'] : [],
            isset($data['artists']) ? $data['artists'] : [],
        );
    }



}
