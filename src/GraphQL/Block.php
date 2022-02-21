<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\ArtistsList;
use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\ShowroomsList;
use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;
use GraphQL\InlineFragment;

class Block implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
                'id',
                'type',
                (new Query('config'))->setSelectionSet(
                    [
                        ShowroomsList::getInlineFragment()
                    ]
                )
            ];
    }

}
