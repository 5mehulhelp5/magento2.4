<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Api\Data\RestaurantInterface;

interface RestaurantRequestInterface
{
    function createOrUpdateRestaurant(array $data): mixed;

    public function buildRestaurant(array $data): RestaurantInterface;
}
