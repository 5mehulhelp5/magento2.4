<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\View\Result\PageFactory;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant as RestaurantResource;
use Stoyanov\Restaurants\Model\RestaurantFactory;

class Index extends Action
{
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RestaurantFactory $restaurantFactory,
        private TimezoneInterface $timezone,
        private RestaurantResource $restaurantResource
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $myNewRestaurant = $this->restaurantFactory->create([]);

            $myNewRestaurant->setId(1)
                ->setName("Leo pizza")
                ->setCapacity(2000)
//                ->setCreatedAt($this->timezone->date()->format('Y-m-d H:i:s'))
                ->setLocation("Sofia");

            //            var_dump($myNewRestaurant->getId());
            //            var_dump($myNewRestaurant->getName());
            //            var_dump($myNewRestaurant->getCapacity());
            //            var_dump($myNewRestaurant->getCreatedAt());
            //            var_dump($myNewRestaurant->getLocation());
//            $this->restaurantResource->save($myNewRestaurant);
            //            $myNewRestaurant->save();
            echo "Created!";
            var_dump($myNewRestaurant);
        } catch (\Exception $exception) {
            die($exception);
        }
        //        return $this->pageFactory->create();
    }
}
