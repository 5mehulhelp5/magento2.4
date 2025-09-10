<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Helper;

use Magento\Framework\App\Helper\{Context, AbstractHelper};
use Stoyanov\Restaurants\Api\{RestaurantRepositoryInterface, Data\RestaurantInterface};
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant\CollectionFactory;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant;

class Data extends AbstractHelper
{
    public function __construct(
        private Context                       $context,
        private RestaurantRepositoryInterface $restaurantRepository,
        private CollectionFactory             $collectionFactory
    ) {
        parent::__construct($context);
    }

    /**
     * @param int $id
     * @return RestaurantInterface
     */
    function getRestaurant(int $id): RestaurantInterface
    {
        return $this->restaurantRepository->getById($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    function deleteRestaurant(int $id): bool
    {
        return $this->restaurantRepository->deleteById($id);
    }

    function getRestaurants(): Restaurant\Collection
    {
        return $this->collectionFactory->create();
    }
}
