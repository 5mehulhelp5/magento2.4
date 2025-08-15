<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Stoyanov\Restaurants\Model\RestaurantRepository;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant\Collection;

class RestaurantsData implements ArgumentInterface
{
    private $restaurantRepository;

    public function __construct(
        RestaurantRepository $restaurantRepository,
    ) {
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @return Collection
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurantRepository->getList();

    }
}
