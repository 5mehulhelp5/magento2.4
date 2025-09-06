<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Model;

use Stoyanov\Restaurants\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant as RestaurantResource;
use Stoyanov\Restaurants\Api\Data\RestaurantInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant\CollectionFactory;
use Stoyanov\Restaurants\Api\Data\RestaurantSearchResultsInterfaceFactory;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function __construct(
        private RestaurantFactory $restaurantFactory,
        private RestaurantResource $restaurantResource,
        private CollectionFactory $collectionFactory,
        private RestaurantSearchResultsInterfaceFactory $searchResultsFactory
    ) {
    }

    /**
     * @param RestaurantInterface $restaurant
     * @return RestaurantInterface
     */
    public function save(RestaurantInterface $restaurant): RestaurantInterface
    {
        try {
            $this->restaurantResource->save($restaurant);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $restaurant;
    }

    public function getById(int $id): RestaurantInterface
    {
        $restaurant = $this->restaurantFactory->create();
        $this->restaurantResource->load($restaurant, $id);
        if (!$restaurant->getEntityId()) {
            throw new NoSuchEntityException(__('Restaurant with ID "%1" does not exist.', $id));
        }
        return $restaurant;
    }

    public function delete(RestaurantInterface $restaurant): bool
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


    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        // Apply filters
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $fields = [];
            $conditions = [];
            foreach ($group->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() ?: 'eq' => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }

        // Apply sort order
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $collection->addOrder(
                $sortOrder->getField(),
                ($sortOrder->getDirection() == \Magento\Framework\Api\SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
            );
        }

        // Apply pagination
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        // Build search results
        /** @var \Stoyanov\Restaurants\Model\RestaurantSearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
