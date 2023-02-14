<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\Documents;
use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\InstallationImages;
use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\RichText;
use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\ShowroomDetails;
use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\ShowroomsList;
use ArtbutlerPhpSdk\GraphQL\ConfigBlocks\WorksList;
use GraphQL\InlineFragment;
use GraphQL\Query;

class Block implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
                'id',
                'type',
                (new Query('config'))->setSelectionSet(
                    [
                        ShowroomsList::getInlineFragment(),
                        ShowroomDetails::getInlineFragment(),
                        Documents::getInlineFragment(),
                        WorksList::getInlineFragment(),
                        InstallationImages::getInlineFragment(),
                        RichText::getInlineFragment(),
                    ]
                )
            ];
    }

}
