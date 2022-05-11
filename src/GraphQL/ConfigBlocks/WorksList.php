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
use GraphQL\RawObject;

class WorksList implements HasSubSelection, IsInlineFragment
{
    public static function getInlineFragment(): InlineFragment
    {
        $subSelectionArray =  self::getSubSelectionArray();

        return (new InlineFragment('WorksList'))
            ->setSelectionSet(
                $subSelectionArray
            );
    }

    public static function getSubSelectionArray(): array
    {
        return  [
            Utils::getFilters('filters'),
            'search',
            'type',
            'slug',
            'layout',
            (new Query('visibleFields', 'WorksList_visibleFields')),
            'enquireEnabled',
            'favoritesEnabled',
            'active',
            (new Query('prices'))->setSelectionSet(
                [
                    'withTax',
                    'priceType'
                ]
            ),
            (new Query('subsections'))
                ->setSelectionSet(
                [
                    WorksSlider::getInlineFragment(),
                ]
            )
        ];
    }



}
