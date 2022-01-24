<?php
namespace ArtbutlerPhpSdk\GraphQL;

class Work
{
    public static function getQuery(){
        return "{
            works(first:100 page:1){
                data    {
                    id
            }
        }}"
        ;
    }
}
