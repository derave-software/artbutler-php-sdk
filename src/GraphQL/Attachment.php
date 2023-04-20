<?php

namespace ArtbutlerPhpSdk\GraphQL;



use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;

class Attachment implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'type',
            Utils::getFile('file'),
            Utils::getTranslation('title'),
            Utils::getTranslation('description'),
            Utils::getTranslation('copyright'),
            Utils::getTranslation('photographer'),
            'categories'
        ];
    }
}
