<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model;

use Magento\Framework\Model\AbstractModel;
use Stoyanov\Restaurant\Api\Data\RestaurantInterface;

class Restaurant extends AbstractModel implements RestaurantInterface
{
    /**
     * Model class
     *
     * @return void
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Restaurant::class);
    }

    /**
     * Get Id
     *
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     *  Set Id
     *
     * @param mixed $id
     *
     * @return Restaurant
     */
    public function setId(mixed $id): Restaurant
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return Restaurant
     */
    public function setName(string $name): Restaurant
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get Capacity
     *
     * @return mixed
     */
    public function getCapacity(): mixed
    {
        return $this->getData(self::CAPACITY);
    }

    /**
     * Set Capacity
     *
     * @param mixed $capacity
     *
     * @return Restaurant
     */
    public function setCapacity(mixed $capacity): Restaurant
    {
        return $this->setData(self::CAPACITY, $capacity);
    }

    /**
     * Get Location
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->getData(self::LOCATION);
    }

    /**
     * Set Location
     *
     * @param string $location
     *
     * @return Restaurant
     */
    public function setLocation(string $location): Restaurant
    {
        return $this->setData(self::LOCATION, $location);
    }
}
