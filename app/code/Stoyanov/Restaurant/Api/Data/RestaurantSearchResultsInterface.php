<?php
namespace Stoyanov\Restaurant\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for restaurant search results.
 */
interface RestaurantSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get restaurants list.
     *
     * @return \Stoyanov\Restaurant\Api\Data\RestaurantInterface[]
     */
    public function getItems();

    /**
     * Set restaurants list.
     *
     * @param \Stoyanov\Restaurant\Api\Data\RestaurantInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}
