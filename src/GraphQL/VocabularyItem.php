<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use ArtbutlerPhpSdk\GraphQL\Utils;

class VocabularyItem implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'name',
            'do_not_delete',
            Utils::getTranslation('human_name')
        ];
    }
}
