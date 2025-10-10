<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Helper;

use Stoyanov\Restaurant\Api\RestaurantBuilderInterface;
use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurant\Api\RequestRestaurantInterface;
use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Stoyanov\Restaurant\Api\RestaurantManagerInterface;

class RequestRestaurant implements RequestRestaurantInterface
{
    /**
     * @param RestaurantManagerInterface $manager
     * @param RestaurantBuilderInterface $builder
     * @param RestaurantRepositoryInterface $restaurantRepository
     */
    public function __construct(
        private RestaurantManagerInterface $manager,
        private RestaurantBuilderInterface $builder,
        private RestaurantRepositoryInterface $restaurantRepository,
    ) {
    }

    /**
     * Create Or Update
     *
     * @param array $data
     *
     * @return mixed
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createOrUpdate(array $data): mixed
    {
        if (!empty($data["entity_id"])) {
            $this->manager->deleteRestaurant((int) $data["entity_id"]);
        }
        $restaurant = $this->build($data);
        $response = $this->restaurantRepository->save($restaurant);
        return $response;
    }

    /**
     * Build
     *
     * @param array $data
     *
     * @return RestaurantInterface
     */
    public function build(array $data): RestaurantInterface
    {
        return $this->builder
            ->build($data);
    }
}
