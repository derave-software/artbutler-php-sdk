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
        return array_values(static::getAvailableSubselections());
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

    public static function getAvailableSubselections(): array
    {
        return [
            "id"=> 'id',
            "draft" => 'draft',
            "human_readable_id" => 'human_readable_id',
            "main_image" => Utils::getFile('main_image'),
            "created_at"=> 'created_at',
            "visible_in_viewer" => 'visible_in_viewer',
            "prices" => static::getPrices(),

            "images" => Utils::getAttachment('images'),
            "documents" => Utils::getAttachment('documents'),
            "title"=>Utils::getTranslation('title'),
            "description"=>Utils::getTranslation('description'),
            'year' =>(new Query('year'))->setSelectionSet([
                'type',
                'description',
                'exact',
                'from',
                'to'
            ]),
            'artists'=>(new Query('artists'))->setSelectionSet(
                [
                    'id',
                    'first_name',
                    'last_name',

                ]
            ),
            'technique'=>Utils::getVocabularyItem('technique'),
            'dimensions_description' => Utils::getTranslation('dimensions_description'),
            'edition' => Utils::getTranslation('edition'),
            'type' => Utils::getVocabularyItem('type'),
            'status'=>Utils::getVocabularyItem('status'),
            'inventory_id'=>'inventory_id',
            'location' =>Utils::getVocabularyItem('location'),
            'signature' => Utils::getTranslation('signature'),
            'tags' => (new Query('tags'))->setSelectionSet(
                Tag::getSubSelectionArray()
            ),
            "video_url"=>'video_url',
            "owner" => 'owner',
            "stock_holder" => 'stock_holder',
            "provenance" => Utils::getTranslation('provenance'),
            "exhibitions" => Utils::getTranslation('exhibitions'),
            "comment" => Utils::getTranslation('comment'),
            "literature" => Utils::getTranslation('literature'),
            "work_size" => static::getDimension('work_size'),
            "frame_size" => static::getDimension('frame_size'),
            "transport_size" => static::getDimension('transport_size'),
            "plate_size" => static::getDimension('plate_size'),
            "plinth_size" => static::getDimension('plinth_size'),
            "vitrine_size" => static::getDimension('vitrine_size'),
            "note" => Utils::getTranslation('note'),
            "shopify_id" => 'shopify_id',
            "variants_ids" => 'variants_ids',
            "exported_to_shopify_at" => 'exported_to_shopify_at',
        ];
    }



}
