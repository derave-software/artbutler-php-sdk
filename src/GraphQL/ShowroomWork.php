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
        return array_values(static::getAvailableSubselections());
    }

    public static function getAvailableSubselections(): array
    {
        return array_merge(
            parent::getAvailableSubselections(),
            [
                "visible_in_viewer" => 'visible_in_viewer',
            ]
        );
    }
}
