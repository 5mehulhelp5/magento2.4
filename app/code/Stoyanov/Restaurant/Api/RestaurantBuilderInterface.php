<?php

namespace Stoyanov\Restaurant\Api;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

interface RestaurantBuilderInterface
{
    public function build(array $data): RestaurantInterface;
}
