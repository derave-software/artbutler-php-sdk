<?php

namespace ArtbutlerPhpSdk\GraphQL\ConfigBlocks;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use ArtbutlerPhpSdk\GraphQL\Concerns\IsInlineFragment;
use ArtbutlerPhpSdk\GraphQL\Utils;
use GraphQL\InlineFragment;
use GraphQL\Query;
use GraphQL\RawObject;

class RichText implements HasSubSelection, IsInlineFragment
{
    public static function getInlineFragment(): InlineFragment
    {
        $subSelectionArray =  self::getSubSelectionArray();

        return (new InlineFragment('RichText'))
            ->setSelectionSet(
                $subSelectionArray
            );
    }

    public static function getSubSelectionArray(): array
    {
        return  [
            'type',
            'slug',
            Utils::getTranslation('richText'),
            'active'
        ];
    }



}
