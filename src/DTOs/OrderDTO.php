<?php

namespace ArtbutlerPhpSdk\DTOs;

use GraphQL\RawObject;

class OrderDTO
{
    public function __construct(
        public ?string $column,
        public string $direction,
    )
    {
    }


     public static function fromArray(array $data): ?self
    {
        if ($data['column'] == null) {
            return null;
        }

        return new self(
            $data['column'] ?? null,
            $data['direction'] ?? 'ASC',
        );
    }

    public function createQueryArgument()
    {
        return new RawObject('{
                      column: '.$this->column.'
                      direction: '.$this->direction.'
          }');
    }
}
