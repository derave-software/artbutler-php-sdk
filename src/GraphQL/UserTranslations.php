<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class UserTranslations implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'group',
            'context',
            Utils::getTranslation('translation'),
        ];
    }
}
