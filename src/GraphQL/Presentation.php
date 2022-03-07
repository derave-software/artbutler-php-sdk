<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class Presentation implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'draft',
            Utils::getTranslation('title'),
            Utils::getTranslation('description'),
            'theme',
            'logoFallback',
            'show_logo',
            'published',
            'public_url',
            'password',
            Utils::getAttachment('images'),
            Utils::getAttachment('documents'),
            Utils::getAttachment('coverImageAttachment'),
        ];
    }

}
