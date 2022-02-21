<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class Showroom implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'draft',
            'human_readable_id',
            Utils::getTranslation('name'),
            Utils::getTranslation('description'),
            Utils::getTranslation('comment'),
            'published',
            Utils::getAttachment('images'),
            Utils::getAttachment('documents'),
            Utils::getFile('coverImage'),
            (new Query('tags'))->setSelectionSet(
                Tag::getSubSelectionArray()
            ),
            'enquire_email',
            'show_social_links',
            'enable_favorite',
            'show_enquire',
            'theme',
            'works_count',
            'url',
            'show_logo',
            'include_taxes'
        ];
    }

}
