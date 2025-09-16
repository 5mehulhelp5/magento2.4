<?php

namespace Stoyanov\Restaurant\Api;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

interface RequestRestaurantInterface
{
    function createOrUpdate(array $data): mixed;

    public function build(array $data): RestaurantInterface;
}
