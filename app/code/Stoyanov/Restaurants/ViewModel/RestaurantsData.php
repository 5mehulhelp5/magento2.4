<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Stoyanov\Restaurants\Helper\Data;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant;

class RestaurantsData implements ArgumentInterface
{
    public function __construct(
        private Data $data,
    ) {
    }

    /**
     * @return Collection
     */
    public function getRestaurants(): Restaurant\Collection
    {
        return $this->data->getRestaurants();
    }
}
