<?php

namespace ArtbutlerPhpSdk\DTOs\Filters;

use GraphQL\RawObject;

class FiltersCollection
{
    /**
     * @var array<Filter>
     */
    public function __construct(public array $filters = [])
    {
    }

    public function addFilter(Filter $filter): FiltersCollection
    {
        $this->filters[] = $filter;

        return $this;
    }

    public static function fromArray($filters): FiltersCollection
    {
        $filtersDTO = [];
        foreach($filters as $filter) {
            $filtersDTO[] = Filter::fromArray($filter);
        }

        return new static($filtersDTO);
    }

    public function createQueryArgument()
    {
        $filtersQuery = [];
        foreach($this->filters as $filter) {
            $filtersQuery[] = $filter->createArgumentQuery();
        }

        return new RawObject('[
        '.implode(',', $filtersQuery).'
                      ]');
    }
}
