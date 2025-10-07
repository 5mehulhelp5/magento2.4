<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Stoyanov\Restaurant\Model\Restaurant;
use Stoyanov\Restaurant\Model\RestaurantFactory;

class RestaurantTest extends TestCase
{
    /**
     * @var Restaurant
     */
    private $restaurantFactory;

    protected function setUp(): void
    {
        $this->restaurantFactory = $this->createMock(RestaurantFactory::class);
    }
    public function testCreateRestaurantWithData(): void
    {
        // Mock Restaurant model
        $restaurant = $this->createMock(Restaurant::class);

        $restaurant->expects($this->once())
            ->method('setName')
            ->with('My Test Restaurant')
            ->willReturnSelf();

        $restaurant->expects($this->once())
            ->method('setCapacity')
            ->with(150)
            ->willReturnSelf();

        $restaurant->expects($this->once())
            ->method('setLocation')
            ->with('Sofia')
            ->willReturnSelf();

        // Factory returns mocked Restaurant
        $this->restaurantFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($restaurant);

        // Test factory + setters
        $restaurantModel = $this->restaurantFactory->create();
        $restaurantModel->setName('My Test Restaurant');
        $restaurantModel->setCapacity(150);
        $restaurantModel->setLocation('Sofia');
    }
}
