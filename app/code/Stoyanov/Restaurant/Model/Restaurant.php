<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model;

use Magento\Framework\Model\AbstractModel;
use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

class Restaurant extends AbstractModel implements RestaurantInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Restaurant::class);
    }

    public function getId(): mixed
    {
        return $this->getData(self::ENTITY_ID);
    }


    public function setId(mixed $id): Restaurant
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    public function setName(string $name): Restaurant
    {
        return $this->setData(self::NAME, $name);
    }

    public function getCapacity(): mixed
    {
        return $this->getData(self::CAPACITY);
    }

    public function setCapacity(mixed $capacity): Restaurant
    {
        return $this->setData(self::CAPACITY, $capacity);
    }

    public function getLocation(): string
    {
        return $this->getData(self::LOCATION);
    }

    public function setLocation(string $location): Restaurant
    {
        return $this->setData(self::LOCATION, $location);
    }
}
