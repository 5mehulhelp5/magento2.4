<?php

namespace Stoyanov\Restaurant\Api;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

interface RequestRestaurantInterface
{
    /**
     * Create Or Update a Restaurant
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createOrUpdate(array $data): mixed;

    /**
     * Build a Restaurant
     *
     * @param array $data
     *
     * @return RestaurantInterface
     */
    public function build(array $data): RestaurantInterface;
}
