<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Stoyanov\Restaurant\Integration\LaravelApiProcessor;

class RestaurantCreatedObserver implements ObserverInterface
{
    /**
     * @param LoggerInterface $logger
     * @param LaravelApiProcessor $laravelApiProcessor
     */
    public function __construct(
        private LoggerInterface $logger,
        private LaravelApiProcessor $laravelApiProcessor
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
        $this->laravelApiProcessor->createRestaurant([
            'name' => $restaurant['name'],
            'capacity' => $restaurant['capacity'],
            'location' => $restaurant['location'],
        ]);
    }
}
