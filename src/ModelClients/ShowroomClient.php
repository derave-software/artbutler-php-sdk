<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\OrderDTO;
use ArtbutlerPhpSdk\DTOs\SearchDTO;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\CESWork;
use ArtbutlerPhpSdk\GraphQL\Page;
use ArtbutlerPhpSdk\GraphQL\Presentation;
use ArtbutlerPhpSdk\GraphQL\ShowroomWork;
use ArtbutlerPhpSdk\GraphQL\Showroom;
use ArtbutlerPhpSdk\GraphQL\Work;
use ArtbutlerPhpSdk\Queries\Presentation\GetPresentation;
use ArtbutlerPhpSdk\Queries\Showroom\GetWorksSlider;
use ArtbutlerPhpSdk\Queries\Showroom\GetWorksSliderFromShowroom;
use ArtbutlerPhpSdk\Queries\Work\GetWorks;
use GraphQL\Query;
use GuzzleHttp\Promise\Promise;
use ArtbutlerPhpSdk\Queries\Showroom\GetShowroom;
use ArtbutlerPhpSdk\Queries\Showroom\GetShowrooms;
use ArtbutlerPhpSdk\GraphQLClient;
use ArtbutlerPhpSdk\Client;

class ShowroomClient extends ModelClient
{
    /**
     * @param int $first
     * @param int $page
     * @param array $filters
     * @return Promise
     */
    public function getShowrooms(
        int $first,
        int $page,
        ?FiltersCollection $filters = null,
        ?SearchDTO $search = null,
        ?OrderDTO $order = null
    ): Promise
    {
        return (new GetShowrooms($this->apiClient))($first, $page, $filters, [], $search, $order);
    }

    /**
     * @param int $id
     * @return Promise
     */
    public function getShowroom(string $id): Promise
    {
        return (new GetShowroom($this->apiClient))($id);
    }

    /**
     * @param int $first pages pagination
     * @param int $page pages pagination
     * @return Promise
     */
    public function getShowroomWithPages(
        string $id,
    ): Promise
    {
        $subSelections = [
            ...Showroom::getSubSelectionArray(),
            (new Query('pages'))
                ->setSelectionSet(
                    Page::getSubSelectionArray()
                )
        ];

        return (new GetShowroom($this->apiClient))($id, $subSelections);
    }

    public function getShowroomsWithWorks(int $first, int $page, ?FiltersCollection $showroomFilters = null, ?FiltersCollection $worksFilters = null, ?SearchDTO $workSearch = null): Promise
    {
        return (new GetShowrooms($this->apiClient))($first, $page, $showroomFilters, [
            ...Showroom::getSubSelectionArray(),
            GetWorks::getQuery($first, $page, ShowroomWork::getSubSelectionArray(), $worksFilters)
        ]);
    }

    public function getShowroomsWithWorksViaWorksSearch(int $first, int $page, ?FiltersCollection $filters = null, ?FiltersCollection $worksFilters = null, ?SearchDTO $workSearch = null): Promise
    {
        return (new GetShowrooms($this->apiClient))($first, $page, $filters, [
            ...Showroom::getSubSelectionArray(),
            GetWorks::getQuery($first, $page, ShowroomWork::getSubSelectionArray(), $worksFilters, $workSearch)
        ]);
    }

    /**
     * @param int $first works pagination
     * @param int $page works pagination
     * @param array $filters works
     * @return Promise
     */
    public function getShowroomWithWorks(
        string $id,
        int $first,
        int $page,
        ?FiltersCollection $filters = null,
        array $workSubSelections = [],
        array $showroomSubselections = []
    ): Promise
    {
        $showroomSubselections = empty($showroomSubselections) ?  Showroom::getSubSelectionArray() : $showroomSubselections;
        $subSelections = [
            ...$showroomSubselections,
            GetWorks::getQuery($first, $page,empty($workSubSelections) ?  ShowroomWork::getSubSelectionArray() : $workSubSelections, $filters)
        ];

        return (new GetShowroom($this->apiClient))($id, $subSelections);
    }

    /**
     * @param int $first works pagination
     * @param int $page works pagination
     * @param array $filters works
     * @return Promise
     */
    public function getWorksSlider(
        string $workId,
        string $showroomId,
        array $workSubSelections = [],
        ?FiltersCollection $filters = null,
    ): Promise
    {
        $workSubSelections =  empty($workSubSelections) ?  ShowroomWork::getSubSelectionArray() : $workSubSelections;

        $subSelections = [
            'id',
            \ArtbutlerPhpSdk\Queries\Work\GetWorksSlider::getQuery($workId,empty($workSubSelections) ?  ShowroomWork::getSubSelectionArray() : $workSubSelections, $filters)
        ];

        return (new GetWorksSliderFromShowroom($this->apiClient))($showroomId, $workId, $subSelections);
    }
}
