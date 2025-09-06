<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Helper;

use Magento\Framework\App\Helper\{Context, AbstractHelper};
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Stoyanov\Restaurants\Api\{RestaurantBuilderInterface, RestaurantRepositoryInterface};
use Stoyanov\Restaurants\Api\Data\RestaurantInterface;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant\CollectionFactory;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant;

class Data extends AbstractHelper
{
    public function __construct(
        private Context                       $context,
        private RestaurantRepositoryInterface $restaurantRepository,
        private TimezoneInterface             $timezone,
        private RestaurantBuilderInterface    $builder,
        private CollectionFactory             $collectionFactory
    ) {
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

    function getRestaurants(): Restaurant\Collection
    {
        return $this->collectionFactory->create();
    }
}
