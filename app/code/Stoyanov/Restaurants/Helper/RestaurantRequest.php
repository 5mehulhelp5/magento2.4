<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Helper;

use Stoyanov\Restaurants\Api\{RestaurantBuilderInterface,
    RestaurantRepositoryInterface,
    RestaurantRequestInterface,
    Data\RestaurantInterface};

class RestaurantRequest implements RestaurantRequestInterface
{
    public function __construct(
        private Data $data,
        private RestaurantBuilderInterface $builder,
        private RestaurantRepositoryInterface $restaurantRepository,


    ) {}

    function createOrUpdateRestaurant(array $data): mixed
    {
        if (!empty($data["id"])) $this->data->deleteRestaurant((int) $data["id"]);
        $restaurant = $this->buildRestaurant($data);
        $response = $this->restaurantRepository->save($restaurant);
        return $response;
    }

    public function buildRestaurant(array $data): RestaurantInterface
    {
        return $this->builder
            ->build($data);
    }
}
