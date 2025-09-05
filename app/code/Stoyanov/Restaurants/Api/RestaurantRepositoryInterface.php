<?php

namespace Stoyanov\Restaurants\Api;

use Stoyanov\Restaurants\Model\ResourceModel\Restaurant as RestaurantResource;
use Stoyanov\Restaurants\Api\Data\RestaurantInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

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
     * @return bool True on success
     * @throws LocalizedException If unable to delete
     */
    public function delete(RestaurantInterface $restaurant): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * @return RestaurantResource\Collection
     */
    public function getList(): RestaurantResource\Collection;
}
