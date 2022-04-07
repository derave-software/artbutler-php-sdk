<?php
namespace ArtbutlerPhpSdk\DTOs;

class WorkDTO
{
    public function __construct(
        public ?string $id,
        public ?string $inventory_id,
        public string $draft,
        public string $human_readable_id,
        public ?array $status,
        public ?array $location,
        public ?array $type,
        public ?array $technique,
        public ?array $main_image,
        public array $title,
        public array $description,
        public array $comment,
        public array $edition,
        public array $signature,
        public array $provenance,
        public array $literature,
        public array $exhibitions,
        public array $dimensions_description,
        public array $year,
        public ?string $video_url,
        public ?string $owner,
        public ?string $stock_holder,
        public array $work_size,
        public array $frame_size,
        public array $transport_size,
        public array $plate_size,
        public array $plinth_size,
        public array $vitrine_size,
        public array $tags,
        public array $images,
        public string $created_at,
        public array $prices,
        public array $artists,
        public ?string $shopifyId
    ){
    }

    public static function createFromArray(array $data): static
    {
        return new static(
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
            isset($data['shopify_id']) ? $data['shopify_id'] : null,
        );
    }

}
