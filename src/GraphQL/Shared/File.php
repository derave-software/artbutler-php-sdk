<?php

namespace ArtbutlerPhpSdk\GraphQL\Shared;

use GraphQL\Query;

class File
{
    public static function getSubSelectionArray()
    {
        return [
            'id',
            'filename',
            'mime',
            'url',
        ];
    }
}
