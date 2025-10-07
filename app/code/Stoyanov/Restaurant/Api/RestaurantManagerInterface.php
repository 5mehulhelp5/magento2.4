<?php

namespace Stoyanov\Restaurant\Api;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant;

interface RestaurantManagerInterface
{
    /**
     * Get Restaurant
     *
     * @param int $id
     *
     * @return RestaurantInterface
     */
    public function getRestaurant(int $id): RestaurantInterface;

    /**
     * Delete Restaurant
     *
     * @param int $id
     *
     * @return bool
     */
    public function deleteRestaurant(int $id): bool;

    /**
     * Get Restaurants
     *
     * @param int $currentPage
     * @param bool $usePaging
     *
     * @return Restaurant\Collection
     */
    public function getRestaurants(int $currentPage, bool $usePaging = false): Restaurant\Collection;
}
