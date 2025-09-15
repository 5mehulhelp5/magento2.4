<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant;
use Magento\Framework\App\RequestInterface;
use Stoyanov\Restaurants\Api\RestaurantManagerInterface;

class RestaurantsDataAdmin implements ArgumentInterface
{
    public function __construct(
        private RestaurantManagerInterface $manager,
        private RequestInterface $request
    ) {
    }

    /**
     * @return Collection
     */
    public function getRestaurants(): Restaurant\Collection
    {
        return $this->manager->getRestaurants($this->getCurrentPage());
    }

    public function getCurrentPage()
    {
        return (int) $this->request->getParam('p', 1);
    }
}
