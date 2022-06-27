<?php

namespace ArtbutlerPhpSdk\GraphQL\Shared;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class Rgba implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'r',
            'g',
            'b',
            'a'
        ];
    }
}