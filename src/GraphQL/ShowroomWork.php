<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class ShowroomWork extends CESWork
{
    public static function getSubSelectionArray(): array
    {
        return [
            ...parent::getSubSelectionArray(),
            'visible_in_viewer'
        ];
    }

}
