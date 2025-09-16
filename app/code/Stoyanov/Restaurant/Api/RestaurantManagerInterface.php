<?php

namespace Stoyanov\Restaurant\Api;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant;

interface RestaurantManagerInterface
{
    /**
     * @param int $id
     * @return RestaurantInterface
     */
    function getRestaurant(int $id): RestaurantInterface;

    /**
     * @param int $id
     * @return bool
     */
    function deleteRestaurant(int $id): bool;

    function getRestaurants(int $currentPage, bool $usePaging=false): Restaurant\Collection;
}
