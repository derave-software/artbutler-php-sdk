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

class ShowroomsList implements HasSubSelection, IsInlineFragment
{
    public static function getInlineFragment(): InlineFragment
    {
        $subSelectionArray =  self::getSubSelectionArray();

        return (new InlineFragment('ShowroomsList'))
            ->setSelectionSet(
                $subSelectionArray
            );
    }

    public static function getSubSelectionArray(): array
    {
        return  [
            Utils::getFilters('filters'),
            'search',
            'slug',
            (new Query('visibleFields', 'ShowroomList_visibleFields')),

            'layout',
            Utils::getTranslation('heading'),
            (new Query('subsections'))->setSelectionSet(
                [
                    Documents::getInlineFragment()
                ]
            ),
            (new Query('order'))->setSelectionSet(
                [
                    'column',
                    'direction'
                ]
            )

        ];
    }



}
