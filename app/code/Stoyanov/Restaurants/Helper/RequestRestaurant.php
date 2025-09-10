<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Helper;

use Stoyanov\Restaurants\Api\{RestaurantBuilderInterface,
    RestaurantRepositoryInterface,
    RequestRestaurantInterface,
    Data\RestaurantInterface};

class RequestRestaurant implements RequestRestaurantInterface
{
    public function __construct(
        private Data $data,
        private RestaurantBuilderInterface $builder,
        private RestaurantRepositoryInterface $restaurantRepository,
    ) {}

    function createOrUpdate(array $data): mixed
    {
        if (!empty($data["id"])) $this->data->deleteRestaurant((int) $data["id"]);
        $restaurant = $this->build($data);
        $response = $this->restaurantRepository->save($restaurant);
        return $response;
    }

    public function build(array $data): RestaurantInterface
    {
        return $this->builder
            ->build($data);
    }
}
