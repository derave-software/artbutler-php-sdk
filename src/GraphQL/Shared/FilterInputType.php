<?php

namespace ArtbutlerPhpSdk\GraphQL\Shared;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class FilterInputType implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'type',
            (new Query('value'))->setSelectionSet(
                [
                    'operator',
                    'data'
                ]
            )
        ];
    }
}
