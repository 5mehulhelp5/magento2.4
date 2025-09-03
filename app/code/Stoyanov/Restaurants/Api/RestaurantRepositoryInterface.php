<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Model\ResourceModel\Restaurant as RestaurantResource;
use Stoyanov\Restaurants\Model\Restaurant;

interface RestaurantRepositoryInterface
{
    /**
     * @param Restaurant $restaurant
     * @return Restaurant
     */
    public function save(Restaurant $restaurant): Restaurant;

    public function getById(int $id): Restaurant;

    public function delete(Restaurant $restaurant): bool;

    public function deleteById(int $id): bool;

    /**
     * @return RestaurantResource\Collection
     */
    public function getList(): RestaurantResource\Collection;
}
