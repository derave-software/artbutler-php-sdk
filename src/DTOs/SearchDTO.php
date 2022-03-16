<?php

namespace ArtbutlerPhpSdk\DTOs;

use GraphQL\RawObject;

class SearchDTO
{
    public function __construct(
        public ?string $search,
        public string $langcode,
    )
    {
    }


     public static function fromArray(array $data): ?self
    {
        if ($data['search'] == null) {
            return null;
        }

        return new self(
            $data['search'] ?? null,
            $data['langcode'] ?? 'en',
        );
    }

    public function createQueryArgument()
    {
        return new RawObject('{
          search: "'. $this->search .'"
          langcode: "'. $this->langcode .'"
              }');

    }
}