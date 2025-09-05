<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Helper;

use Magento\Framework\App\Helper\{Context, AbstractHelper};
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Stoyanov\Restaurants\Api\{RestaurantBuilderInterface, RestaurantRepositoryInterface};
use Stoyanov\Restaurants\Api\Data\RestaurantInterface;

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
     * @param array $data
     * @return mixed
     */
    function createOrUpdateRestaurant(array $data): mixed
    {
        if (!empty($data["id"])) $this->deleteRestaurant((int) $data["id"]);
        $restaurant = $this->buildRestaurant($data);
        $response = $this->restaurantRepository->save($restaurant);
        return $response;
    }

    /**
     * @param int $id
     * @return RestaurantInterface
     */
    function getRestaurant(int $id): RestaurantInterface
    {
        return $this->restaurantRepository->getById($id);
    }

    /**
     * @param array $data
     * @return RestaurantInterface
     */
    private function buildRestaurant(array $data): RestaurantInterface
    {
        return $this->builder
            ->build($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    function deleteRestaurant(int $id): bool
    {
        return $this->restaurantRepository->deleteById($id);
    }
}
