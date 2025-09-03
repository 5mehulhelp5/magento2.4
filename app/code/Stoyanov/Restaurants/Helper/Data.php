<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Helper;

use Magento\Framework\App\Helper\{Context, AbstractHelper};
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Stoyanov\Restaurants\Api\{RestaurantBuilderInterface, RestaurantRepositoryInterface};
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
        RestaurantBuilderInterface    $builder,
    ) {
        $this->restaurantRepository = $restaurantRepository;
        $this->timezone             = $timezone;
        $this->builder              = $builder;
        parent::__construct($context);

    }

    /**
     * @return mixed
     */
    function createOrUpdateRestaurant($data): mixed
    {
        if (!empty($data["id"])) $this->deleteRestaurant($data["id"]);
        $restaurant = $this->buildRestaurant($data);
        $response = $this->restaurantRepository->save($restaurant);
        return $response;
    }

    /**
     * @param $id
     * @return Restaurant
     */
    function getRestaurant($id): Restaurant
    {
        return $this->restaurantRepository->getById((int) $id);
    }

    /**
     * @param $data
     * @return Restaurant
     */
    private function buildRestaurant($data): Restaurant
    {
        return $this->builder
            ->setName($data["name"])
            ->setCapacity((int) $data["capacity"])
            ->setLocation($data["location"])
            ->setCreatedAt($this->timezone->date()->format('Y-m-d H:i:s'))
            ->build();
    }

    /**
     * @param $id
     * @return bool
     */
    function deleteRestaurant($id): bool
    {
        return $this->restaurantRepository->deleteById((int) $id);
    }


}
