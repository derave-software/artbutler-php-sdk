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
    ){
    }
}
