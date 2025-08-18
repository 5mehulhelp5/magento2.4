<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Stoyanov\Restaurants\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurants\Model\RestaurantBuilder;
use Stoyanov\Restaurants\Model\Restaurant;

class Data extends AbstractHelper
{
    private $restaurantRepository;
    private $timezone;

    private $builder;

    public function __construct(
        Context                       $context,
        RestaurantRepositoryInterface $restaurantRepository,
        TimezoneInterface             $timezone,
        RestaurantBuilder             $builder,
    ) {
        $this->restaurantRepository = $restaurantRepository;
        $this->timezone             = $timezone;
        $this->builder              = $builder;
        parent::__construct($context);

    }

    /**
     * @param $countRestaurants
     * @return int
     */
    private function calculateEntityIdValue($countRestaurants): int
    {
        $entityId = $countRestaurants + 1;
        if ($countRestaurants === 0) $entityId = 1;
        return $entityId;
    }

    /**
     * @return mixed
     */
    public function createRestaurant(): mixed
    {
        $countRestaurants = $this->restaurantRepository->getList()->getSize();
        $restaurant = $this->builder
            ->setId($this->calculateEntityIdValue($countRestaurants))
            ->setName($this->_request->getPost("name"))
            ->setCapacity((int) $this->_request->getPost("capacity"))
            ->setLocation($this->_request->getPost("location"))
            ->setCreatedAt($this->timezone->date()->format('Y-m-d H:i:s'))
            ->build();
        $response = $this->restaurantRepository->save($restaurant);
        return $response;
    }

    /**
     * @param $id
     * @return Restaurant
     */
    public function getRestaurant($id): Restaurant
    {
        return $this->restaurantRepository->getById((int) $id);
    }

    public function updateRestaurant($data): mixed
    {
        $restaurant = $this->builder
            ->setId((int) $data["id"])
            ->setName($data["name"])
            ->setCapacity((int) $data["capacity"])
            ->setLocation($data["location"])
            ->setCreatedAt($this->timezone->date()->format('Y-m-d H:i:s'))
            ->build();
        $response = $this->restaurantRepository->save($restaurant);
        return $response;
    }
}
