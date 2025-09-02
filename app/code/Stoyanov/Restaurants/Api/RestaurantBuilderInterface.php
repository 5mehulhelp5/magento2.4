<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Model\Restaurant;

interface RestaurantBuilderInterface
{
    public function setName(string $name): \Stoyanov\Restaurants\Model\RestaurantBuilder;

    public function setCapacity(int $capacity): \Stoyanov\Restaurants\Model\RestaurantBuilder;

    public function setLocation(string $location): \Stoyanov\Restaurants\Model\RestaurantBuilder;

    public function setCreatedAt(string $createdAt): \Stoyanov\Restaurants\Model\RestaurantBuilder;

    public function build(): Restaurant;
}
