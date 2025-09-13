<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Api\Data\RestaurantInterface;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant;

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
