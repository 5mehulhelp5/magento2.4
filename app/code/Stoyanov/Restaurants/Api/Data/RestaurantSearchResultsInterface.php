<?php
namespace Stoyanov\Restaurants\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for restaurant search results.
 */
interface RestaurantSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get restaurants list.
     *
     * @return \Stoyanov\Restaurants\Api\Data\RestaurantInterface[]
     */
    public function getItems();

    /**
     * Set restaurants list.
     *
     * @param \Stoyanov\Restaurants\Api\Data\RestaurantInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
