<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class RestaurantCreatedObserver implements ObserverInterface
{
    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    /**
     * Execute action
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer): void
    {
        // Get data from event
        $restaurant = $observer->getData('restaurant');

        // Log data
        $this->logger->info(
            '
        New restaurant created: ' . $restaurant['name'] . ' | Capacity: ' .
            $restaurant['capacity'] . ' | Location: ' . $restaurant['location']
        );
    }
}
