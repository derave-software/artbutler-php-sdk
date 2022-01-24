<?php

namespace ArtbutlerPhpSdk\GraphQL\Shared;

use GraphQL\Query;

class Tag
{
    public static function getSubSelectionArray()
    {
        return (new Query('tags'))->setSelectionSet([
            'id',
            'name',
            'type',
        ]);
    }
}
