<?php

namespace ArtbutlerPhpSdk\GraphQL\ConfigBlocks;

use ArtbutlerPhpSdk\GraphQL\Concerns\IsInlineFragment;
use ArtbutlerPhpSdk\GraphQL\Utils;
use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\InlineFragment;
use GraphQL\Query;

class WorksSlider implements HasSubSelection, IsInlineFragment
{
    public static function getInlineFragment(): InlineFragment
    {
        $subSelectionArray =  self::getSubSelectionArray();

        return (new InlineFragment('WorksSlider'))
            ->setSelectionSet(
                $subSelectionArray
            );
    }

    public static function getSubSelectionArray(): array
    {
        return  [
            'type',
            'slug',
            'layout',
            'visibleFields',
            'enquireEnabled',
            'favoritesEnabled',
            'active'
        ];
    }



}
