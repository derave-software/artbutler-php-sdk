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
            Utils::getTranslation('contact_address'),
            Utils::getTranslation('description'),
            'theme',
            'logoFallback',
            'show_logo',
            'published',
            'public_url',
            'password',
            (new Query('configPrices'))->setSelectionSet(
                [
                    'withTax',
                    'priceType',
                ]
            ),
            Utils::getAttachment('images'),
            Utils::getAttachment('documents'),
            Utils::getAttachment('coverImageAttachment'),
            'enquire_email',
            'fallback_email',
            'enquire_email',
            'fallback_email',
            'font',
            'font_url'
        ];
    }

}
