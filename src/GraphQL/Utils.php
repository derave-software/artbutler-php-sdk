<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\FilterInputType;
use GraphQL\Query;

class Utils
{
    public static function getTranslation(string $field): Query
    {
        return (new Query($field))->setSelectionSet(
            [
                'langcode',
                'text',
            ]
        );
    }

    public static function getVocabularyItem(string $vocabularyItem):Query
    {
        return (new Query($vocabularyItem))->setSelectionSet(
            VocabularyItem::getSubSelectionArray()
        );
    }

    public static function getAttachment(string $attachment):Query
    {
        return (new Query($attachment))->setSelectionSet(
            Attachment::getSubSelectionArray()
        );
    }

    public static function getFile(string $fileField):Query
    {
        return (new Query($fileField))->setSelectionSet(
            File::getSubSelectionArray()
        );
    }
    
    public static function getFilters(string $fileField):Query
    {
        return (new Query($fileField))->setSelectionSet(
            FilterInputType::getSubSelectionArray()
        );
    }

}
