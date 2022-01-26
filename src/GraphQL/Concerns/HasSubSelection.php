<?php
namespace ArtbutlerPhpSdk\GraphQL\Concerns;

use GraphQL\Query;

interface HasSubSelection
{
    public static function getSubSelectionArray(): array;
}
