<?php

namespace ArtbutlerPhpSdk\GraphQL;

use ArtbutlerPhpSdk\GraphQL\VocabularyItem;
use ArtbutlerPhpSdk\GraphQL\Shared\File;
use ArtbutlerPhpSdk\GraphQL\Shared\Tag;
use ArtbutlerPhpSdk\GraphQL\Concerns\HasSubSelection;
use GraphQL\Query;

class Work implements HasSubSelection
{
    public static function getSubSelectionArray(): array
    {
        return [
            'id',
            'inventory_id',
            'draft',
            'human_readable_id',
            Utils::getVocabularyItem('status'),
            Utils::getVocabularyItem('location'),
            Utils::getVocabularyItem('type'),
            Utils::getVocabularyItem('technique'),
            Utils::getFile('main_image'),
            Utils::getTranslation('title'),
            Utils::getTranslation('description'),
            Utils::getTranslation('comment'),
            Utils::getTranslation('edition'),
            Utils::getTranslation('signature'),
            Utils::getTranslation('provenance'),
            Utils::getTranslation('literature'),
            Utils::getTranslation('exhibitions'),
            Utils::getTranslation('dimensions_description'),
            (new Query('year'))->setSelectionSet([
                'type',
                'description',
                'exact',
                'from',
                'to'
            ]),
            'video_url',
            'owner',
            'stock_holder',
            static::getDimension('work_size'),
            static::getDimension('frame_size'),
            static::getDimension('transport_size'),
            static::getDimension('plate_size'),
            static::getDimension('plinth_size'),
            static::getDimension('vitrine_size'),
            (new Query('tags'))->setSelectionSet(
                Tag::getSubSelectionArray()
            ),
            Utils::getAttachment('images'),
            Utils::getAttachment('documents'),
            'created_at',
            static::getPrices(),
            (new Query('artists'))->setSelectionSet(
                [
                    'id',
                    'first_name',
                    'last_name',

                ]
            )
        ];
    }

    public static function getPrices(): Query
    {
        return (new Query('prices'))->setSelectionSet(
            [
                'type',
                'net',
                'vat',
                'gross',
                'currency'
            ]
        );
    }

    public static function getDimension(string $name): Query
    {
        return (new Query($name))->setSelectionSet(
            [
                'unit',
                'accuracy',
                'height',
                'width',
                'depth',
                'diameter'
            ]
        );
    }

}
