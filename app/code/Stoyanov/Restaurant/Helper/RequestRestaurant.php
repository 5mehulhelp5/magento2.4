<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Helper;

use Stoyanov\Restaurant\Api\{RestaurantBuilderInterface,
    RestaurantRepositoryInterface,
    RequestRestaurantInterface,
    Data\RestaurantInterface,
    RestaurantManagerInterface};

class RequestRestaurant implements RequestRestaurantInterface
{
    public function __construct(
        private RestaurantManagerInterface $manager,
        private RestaurantBuilderInterface $builder,
        private RestaurantRepositoryInterface $restaurantRepository,
    ) {}

    function createOrUpdate(array $data): mixed
    {
        if (!empty($data["id"])) $this->manager->deleteRestaurant((int) $data["id"]);
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
