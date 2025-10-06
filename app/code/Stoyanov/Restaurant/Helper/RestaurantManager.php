<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Helper;

use Stoyanov\Restaurant\{
    Api\Data\RestaurantInterface,
    Api\RestaurantManagerInterface,
    Api\RestaurantRepositoryInterface,
    Model\ResourceModel\Restaurant,
    Model\ResourceModel\Restaurant\CollectionFactory
};

class RestaurantManager implements RestaurantManagerInterface
{
    public function __construct(
        private RestaurantRepositoryInterface $restaurantRepository,
        private CollectionFactory             $collectionFactory,
        private Data $data
    )
    {
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
     * @param int $id
     * @return bool
     */
    function deleteRestaurant(int $id): bool
    {
        return $this->restaurantRepository->deleteById($id);
    }

    function getRestaurants(int $currentPage, bool $usePaging=false): Restaurant\Collection
    {
        if ($usePaging === false) return $this->collectionFactory->create();
        $collection = $this->collectionFactory->create();
        $collection->setPageSize($this->data->getConfigValue("page_size"));
        $collection->setCurPage($currentPage);
        return $collection;
    }
}
