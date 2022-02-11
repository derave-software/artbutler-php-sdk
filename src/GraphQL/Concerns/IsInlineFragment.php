<?php
namespace ArtbutlerPhpSdk\GraphQL\Concerns;

use GraphQL\InlineFragment;
use GraphQL\Query;

interface IsInlineFragment
{
    public static function getInlineFragment(): InlineFragment;
}
