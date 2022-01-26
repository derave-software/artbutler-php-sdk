<?php

namespace ArtbutlerPhpSdk\GraphQL\Shared;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class Tag implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'name',
            'type',
        ];
    }
}
