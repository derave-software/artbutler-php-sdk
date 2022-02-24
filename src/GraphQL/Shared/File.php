<?php

namespace ArtbutlerPhpSdk\GraphQL\Shared;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class File implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'filename',
            'mime',
            'url',
            'thumbnail'
        ];
    }
}
