<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Model;

use Stoyanov\Restaurant\{
    Api\RestaurantRepositoryInterface,
    Model\ResourceModel\Restaurant as RestaurantResource,
    Api\Data\RestaurantSearchResultsInterfaceFactory,
    Api\Data\RestaurantInterface,
};
use Magento\Framework\Api\{
    SearchCriteria\CollectionProcessor,
    SearchResults,
    SearchCriteriaInterface,
};

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function __construct(
        private RestaurantFactory $restaurantFactory,
        private RestaurantResource $restaurantResource,
        private RestaurantSearchResultsInterfaceFactory $searchResultsFactory,
        private CollectionProcessor $collectionProcessor
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

    public function getSearchResultsList(SearchCriteriaInterface $searchCriteria): SearchResults
    {
        $collection = $this->restaurantFactory->create()->getCollection();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getData());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
