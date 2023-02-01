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
            Utils::getAttachment('coverImageAttachment'),
            (new Query('tags'))->setSelectionSet(
                Tag::getSubSelectionArray()
            ),
            'enquire_email',
            'fallback_email',
            'password',
            'show_social_links',
            'theme',
            'works_count',
            'url',
            'show_logo',
            'logo_fallback',
            'include_taxes',
            'show_cover_image',
            Utils::getRgba('primary_color'),
            Utils::getRgba('secondary_color'),
            Utils::getRgba('tertiary_color'),
            Utils::getRgba('background_color'),
            Utils::getRgba('hero_text_color'),
            'primary_font',
            'primary_font_url',
            'secondary_font',
            'secondary_font_url',
        ];
    }

}
