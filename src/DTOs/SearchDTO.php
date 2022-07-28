<?php

namespace ArtbutlerPhpSdk\DTOs;

use GraphQL\RawObject;

class SearchDTO
{
    public function __construct(
        public ?string $search,
        public string $langcode,
        public array $fields = []
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
        $fields = empty($this->fields) ? '' : 'columns: ["'. implode('","', $this->fields) .'"]';

        return new RawObject('{
          search: "'. urlencode($this->search) .'"
          langcode: "'. $this->langcode .'"
           '.$fields.'}');

    }
}
