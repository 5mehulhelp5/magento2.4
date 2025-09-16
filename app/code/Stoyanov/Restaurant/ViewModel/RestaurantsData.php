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
    public function __construct(
        private RestaurantManagerInterface $manager,
        private RequestInterface $request,
        private Data $data,
    ) {
    }

    /**
     * @return Collection
     */
    function getRestaurants(): Restaurant\Collection
    {
        return $this->manager->getRestaurants($this->getCurrentPage(), true);
    }

    private function getCurrentPage() : int
    {
        return (int) $this->request->getParam('p', 1);
    }
    function getNextPage(): int
    {
        $nextPage = $this->getCurrentPage() + 1;
        if ($nextPage >  $this->getCollectionCount() / $this->getPageSize()) $nextPage = $this->getCurrentPage();
        return $nextPage;
    }

    function getPrevPage(): int
    {
        $prevPage = $this->getCurrentPage() - 1;
        if ($prevPage < 1) $prevPage = 1;
        return $prevPage;
    }

    private function getPageSize(): int
    {
        return (int) $this->data->getConfigValue("page_size");
    }

    private function getCollectionCount(): int
    {
        return (int) $this->getRestaurants()->getSize();
    }

    public function showPaging(): bool
    {
        $minimumSize = (int) $this->data->getConfigValue("minimum_size");
        if ((int) $this->getRestaurants()->getSize() == 0) return false;
        if ((int) $this->getRestaurants()->getSize() >= $minimumSize) return true;
        return false;
    }
}
