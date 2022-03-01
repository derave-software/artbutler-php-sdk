<?php
namespace ArtbutlerPhpSdk\DTOs\Filters;

class Filter
{
    public function __construct(
        public string $type,
        public string $operator,
        public ?string $data,
    ){
    }

    public static function fromArray(array $data): Filter
    {
        return new Filter(
            $data['type'],
            $data['value']['operator'],
            $data['value']['data'],
        );
    }

    public function createArgumentQuery(): string
    {
        return '
        {
            type: "'.$this->type.'",
            value: {
                operator: '.$this->operator.',
                data: "'.$this->data.'"
            }
         }';
    }
}
