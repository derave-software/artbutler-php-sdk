<?php

namespace ArtbutlerPhpSdk\GraphQL\Shared;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class ContentLanguages implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            (new Query('content_languages'))->setSelectionSet(
                [
                    'locale_code',
                    'name',
                    'label'
                ]
            )
        ];
    }
}
