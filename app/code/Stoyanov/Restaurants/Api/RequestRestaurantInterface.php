<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Api\Data\RestaurantInterface;

interface RequestRestaurantInterface
{
    function createOrUpdate(array $data): mixed;

    public function build(array $data): RestaurantInterface;
}
