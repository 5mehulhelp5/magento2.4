<?php

namespace Stoyanov\Restaurant\Api;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;

interface RestaurantRepositoryInterface
{
    /**
     * Save restaurant.
     *
     * @param RestaurantInterface $restaurant
     * @return RestaurantInterface
     * @throws LocalizedException If unable to save
     */
    public function save(RestaurantInterface $restaurant): RestaurantInterface;

    /**
     * Retrieve restaurant by ID.
     *
     * @param int $id
     * @return RestaurantInterface
     * @throws NoSuchEntityException If restaurant does not exist
     * @throws LocalizedException On other errors
     */
    public function getById(int $id): RestaurantInterface;

    /**
     * Delete restaurant.
     *
     * @param RestaurantInterface $restaurant
     *
     * @return bool True on success
     *
     * @throws LocalizedException If unable to delete
     */
    public function delete(RestaurantInterface $restaurant): bool;

    /**
     * Delete By Id restaurant
     *
     * @param int $id
     *
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * Get Search Results List
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return SearchResults
     */
    public function getSearchResultsList(SearchCriteriaInterface $searchCriteria): SearchResults;
}
