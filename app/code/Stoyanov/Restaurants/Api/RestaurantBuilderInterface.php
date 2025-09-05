<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Api\Data\RestaurantInterface;

interface RestaurantBuilderInterface
{
    public function build(array $data): RestaurantInterface;
}
