<?php
namespace ArtbutlerPhpSdk\ModelClients;

use ArtbutlerPhpSdk\DTOs\Filters\FiltersCollection;
use ArtbutlerPhpSdk\DTOs\OrderDTO;
use ArtbutlerPhpSdk\DTOs\SearchDTO;
use ArtbutlerPhpSdk\DTOs\WorkDTO;
use ArtbutlerPhpSdk\GraphQL\CESWork;
use ArtbutlerPhpSdk\GraphQL\ShowroomWork;
use ArtbutlerPhpSdk\GraphQL\Showroom;
use ArtbutlerPhpSdk\GraphQL\Work;
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
        ?FiltersCollection $filters = null): Promise
    {
        $subSelections = [
            ...Showroom::getSubSelectionArray(),
            GetWorks::getQuery($first, $page, ShowroomWork::getSubSelectionArray(), $filters)
        ];

        return (new GetShowroom($this->apiClient))($id, $subSelections);
    }
}
