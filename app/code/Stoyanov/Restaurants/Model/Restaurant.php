<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Model;

use Magento\Framework\Model\AbstractModel;
use Stoyanov\Restaurants\Api\Data\RestaurantInterface;

class Restaurant extends AbstractModel implements RestaurantInterface
{
    protected function _construct()
    {
        $this->_init(\Stoyanov\Restaurants\Model\ResourceModel\Restaurant::class);
    }
    public const string ENTITY_ID = 'id';
    public const string NAME = 'name';
    public const string CAPACITY = 'capacity';
    public const string CREATED_AT = 'created_at';
    public const string LOCATION = 'location';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @param $id
     * @return Restaurant
     */
    public function setId($id): Restaurant
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return Restaurant
     */
    public function setName(string $name): Restaurant
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return int
     */
    public function getCapacity()
    {
        return $this->getData(self::CAPACITY);
    }

    /**
     * @param int $capacity
     * @return Restaurant
     */
    public function setCapacity(int $capacity): Restaurant
    {
        return $this->setData(self::CAPACITY, $capacity);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param string $createdAt
     * @return Restaurant
     */
    public function setCreatedAt($createdAt): Restaurant
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->getData(self::LOCATION);
    }

    /**
     * @param string $location
     * @return Restaurant
     */
    public function setLocation($location): Restaurant
    {
        return $this->setData(self::LOCATION, $location);
    }
}
