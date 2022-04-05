<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class GeneralSettings implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            (new Query('social_media'))->setSelectionSet(
                [
                    'url',
                    'type',
                ]
            ),
        ];
    }
}
