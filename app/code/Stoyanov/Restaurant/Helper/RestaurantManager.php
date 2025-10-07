<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Helper;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Stoyanov\Restaurant\Api\RestaurantManagerInterface;
use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant\CollectionFactory;

class RestaurantManager implements RestaurantManagerInterface
{
    /**
     * @param RestaurantRepositoryInterface $restaurantRepository
     * @param CollectionFactory $collectionFactory
     * @param Data $data
     */
    public function __construct(
        private RestaurantRepositoryInterface $restaurantRepository,
        private CollectionFactory             $collectionFactory,
        private Data $data
    ) {
    }

    /**
     * Cet Restaurant
     *
     * @param int $id
     *
     * @return RestaurantInterface
     */
    public function getRestaurant(int $id): RestaurantInterface
    {
        return $this->restaurantRepository->getById($id);
    }

    /**
     * Delete Restaurant
     *
     * @param int $id
     *
     * @return bool
     */
    public function deleteRestaurant(int $id): bool
    {
        return $this->restaurantRepository->deleteById($id);
    }

    /**
     * Get Restaurants
     *
     * @param int $currentPage
     * @param bool $usePaging
     *
     * @return Restaurant\Collection
     */
    public function getRestaurants(int $currentPage, bool $usePaging = false): Restaurant\Collection
    {
        if ($usePaging === false) {
            return $this->collectionFactory->create();
        }
        $collection = $this->collectionFactory->create();
        $collection->setPageSize($this->data->getConfigValue("page_size"));
        $collection->setCurPage($currentPage);
        return $collection;
    }
}
