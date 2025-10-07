<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant;
use Magento\Framework\App\RequestInterface;
use Stoyanov\Restaurant\Api\RestaurantManagerInterface;
use Stoyanov\Restaurant\Helper\Data;

class RestaurantsData implements ArgumentInterface
{
    /**
     * @param RestaurantManagerInterface $manager
     * @param RequestInterface $request
     * @param Data $data
     */
    public function __construct(
        private RestaurantManagerInterface $manager,
        private RequestInterface $request,
        private Data $data,
    ) {
    }

    /**
     * Get Restaurants
     *
     * @return Collection
     */
    public function getRestaurants(): Restaurant\Collection
    {
        return $this->manager->getRestaurants($this->getCurrentPage(), true);
    }

    /**
     * Get Current Page
     *
     * @return int
     */
    private function getCurrentPage() : int
    {
        return (int) $this->request->getParam('p', 1);
    }

    /**
     * Get Next Page
     *
     * @return int
     */
    public function getNextPage(): int
    {
        $nextPage = $this->getCurrentPage() + 1;
        if ($nextPage >  $this->getCollectionCount() / $this->getPageSize()) {
            $nextPage = $this->getCurrentPage();
        }

        return $nextPage;
    }

    /**
     * Get Prev Page
     *
     * @return int
     */
    public function getPrevPage(): int
    {
        $prevPage = $this->getCurrentPage() - 1;
        if ($prevPage < 1) {
            $prevPage = 1;
        }
        return $prevPage;
    }

    /**
     * Get Page Size
     *
     * @return int
     */
    private function getPageSize(): int
    {
        return (int) $this->data->getConfigValue("page_size");
    }

    /**
     * Get Collection Count
     *
     * @return int
     */
    private function getCollectionCount(): int
    {
        return (int) $this->getRestaurants()->getSize();
    }

    /**
     * Show Paging
     *
     * @return bool
     */
    public function showPaging(): bool
    {
        $minimumSize = (int) $this->data->getConfigValue("minimum_size");
        if ((int) $this->getRestaurants()->getSize() == 0) {
            return false;
        }
        if ((int) $this->getRestaurants()->getSize() >= $minimumSize) {
            return true;
        }
        return false;
    }
}
