<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class ShowroomSettings implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            Utils::getTranslation('contact_information'),
        ];
    }
}
