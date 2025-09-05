<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Model\ResourceModel\Restaurant as RestaurantResource;
use Stoyanov\Restaurants\Api\Data\RestaurantInterface;

interface RestaurantRepositoryInterface
{
    /**
     * @param RestaurantInterface $restaurant
     * @return RestaurantInterface
     */
    public function save(RestaurantInterface $restaurant): RestaurantInterface;

    public function getById(int $id): RestaurantInterface;

    public function delete(RestaurantInterface $restaurant): bool;

    public function deleteById(int $id): bool;

    /**
     * @return RestaurantResource\Collection
     */
    public function getList(): RestaurantResource\Collection;
}
