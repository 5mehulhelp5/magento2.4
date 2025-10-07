<?php

namespace Stoyanov\Restaurant\Api;

use Magento\Framework\Exception\LocalizedException;
use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

interface FormInterface
{
    /**
     * Get Form Action
     *
     * @return string
     */
    public function getFormAction(): string;

    /**
     * Get Restaurant
     *
     * @param $id
     *
     * @return RestaurantInterface
     *
     * @throws LocalizedException
     */
    public function getRestaurant($id = null): RestaurantInterface;
}
