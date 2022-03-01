<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class CESWork extends Work implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            ...parent::getSubSelectionArray(),
            'price_type',
            'price_description',
        ];
    }
}