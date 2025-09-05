<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Model;

use Magento\Framework\Model\AbstractModel;
use Stoyanov\Restaurants\Api\Data\RestaurantInterface;

class Restaurant extends AbstractModel implements RestaurantInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Restaurant::class);
    }

    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getCapacity()
    {
        return $this->getData(self::CAPACITY);
    }

    public function setCapacity($capacity)
    {
        return $this->setData(self::CAPACITY, $capacity);
    }

    public function getLocation()
    {
        return $this->getData(self::LOCATION);
    }

    public function setLocation($location)
    {
        return $this->setData(self::LOCATION, $location);
    }
}
