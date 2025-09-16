<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model;

use Stoyanov\Restaurant\Api\RestaurantBuilderInterface;
use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

class RestaurantBuilder implements RestaurantBuilderInterface
{
    public function __construct(protected RestaurantFactory $restaurantFactory)
    {
    }

    public function build(array $data): RestaurantInterface
    {
        /** @var Restaurant $restaurant */
        $restaurant = $this->restaurantFactory->create();
        if (!empty($data["name"])) $restaurant->setName($data["name"]);
        if (!empty($data["capacity"])) $restaurant->setCapacity($data["capacity"]);
        if (!empty($data["location"])) $restaurant->setLocation($data["location"]);
        return $restaurant;
    }
}
