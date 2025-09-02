<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Model;

use Stoyanov\Restaurants\Api\RestaurantBuilderInterface;

class RestaurantBuilder implements RestaurantBuilderInterface
{
    protected $restaurantFactory;

    protected $data = [];

    public function __construct(RestaurantFactory $restaurantFactory)
    {
        $this->restaurantFactory = $restaurantFactory;
    }

    public function setName(string $name): self
    {
        $this->data['name'] = $name;
        return $this;
    }

    public function setCapacity(int $capacity): self
    {
        $this->data['capacity'] = $capacity;
        return $this;
    }

    public function setLocation(string $location): self
    {
        $this->data['location'] = $location;
        return $this;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->data['created_at'] = $createdAt;
        return $this;
    }

    public function build(): Restaurant
    {
        /** @var Restaurant $restaurant */
//        var_dump($this->data);
//        die;
        $restaurant = $this->restaurantFactory->create();
        $restaurant->setData($this->data);
        $this->data = []; // reset builder for reuse
        return $restaurant;
    }
}
