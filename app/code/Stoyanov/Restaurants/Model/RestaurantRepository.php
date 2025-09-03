<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Model;

use Stoyanov\Restaurants\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant as RestaurantResource;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant\CollectionFactory as RestaurantCollectionFactory;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function __construct(
        private RestaurantFactory $restaurantFactory,
        private RestaurantResource $restaurantResource,
        private RestaurantCollectionFactory $restaurantCollectionFactory
    ) {
    }

    /**
     * @param Restaurant $restaurant
     * @return Restaurant
     */
    public function save(Restaurant $restaurant): Restaurant
    {
        try {
            $this->restaurantResource->save($restaurant);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $restaurant;
    }

    public function getById(int $id): Restaurant
    {
        $restaurant = $this->restaurantFactory->create();
        $this->restaurantResource->load($restaurant, $id);
        if (!$restaurant->getEntityId()) {
            throw new NoSuchEntityException(__('Restaurant with ID "%1" does not exist.', $id));
        }
        return $restaurant;
    }

    public function delete(Restaurant $restaurant): bool
    {
        try {
            $this->restaurantResource->delete($restaurant);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    public function deleteById(int $id): bool
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @return RestaurantResource\Collection
     */
    public function getList(): RestaurantResource\Collection
    {
        return $this->restaurantCollectionFactory->create();
    }
}
