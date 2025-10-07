<?php

namespace Stoyanov\Restaurant\Api;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

interface RestaurantBuilderInterface
{
    /**
     * Build Restaurant action
     *
     * @param array $data
     *
     * @return RestaurantInterface
     */
    public function build(array $data): RestaurantInterface;
}
