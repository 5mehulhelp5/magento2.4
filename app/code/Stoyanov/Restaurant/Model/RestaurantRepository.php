<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Model;

use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant as RestaurantResource;
use Stoyanov\Restaurant\Api\Data\RestaurantSearchResultsInterfaceFactory;
use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchCriteriaInterface;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    /**
     * @param RestaurantFactory $restaurantFactory
     * @param RestaurantResource $restaurantResource
     * @param RestaurantSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessor $collectionProcessor
     */
    public function __construct(
        private RestaurantFactory $restaurantFactory,
        private RestaurantResource $restaurantResource,
        private RestaurantSearchResultsInterfaceFactory $searchResultsFactory,
        private CollectionProcessor $collectionProcessor
    ) {
    }

    /**
     * Save Restaurant action
     *
     * @param RestaurantInterface $restaurant
     *
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

    /**
     * Get Restaurant by id action
     *
     * @param int $id
     *
     * @return RestaurantInterface
     */
    public function getById(int $id): RestaurantInterface
    {
        $restaurant = $this->restaurantFactory->create();
        $this->restaurantResource->load($restaurant, $id);
        if (!$restaurant->getEntityId()) {
            throw new NoSuchEntityException(__('Restaurant with ID "%1" does not exist.', $id));
        }
        return $restaurant;
    }

    /**
     * Delete Restaurant  action
     *
     * @param RestaurantInterface $restaurant
     *
     * @return bool
     */
    public function delete(RestaurantInterface $restaurant): bool
    {
        try {
            $this->restaurantResource->delete($restaurant);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    /**
     * Delete Restaurant by id action
     *
     * @param int $id
     *
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->getById($id));
    }

    /**
     * Get Search Results List action
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return SearchResults
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
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
