<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class Page implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            Utils::getTranslation('name'),
            'slug',
            'show_in_main_menu',
            'show_in_footer_menu',
            'published',
            'order_column',
            'password',
            (new Query('blocks'))->setSelectionSet(
                Block::getSubSelectionArray()
            )
            ];
    }

}
