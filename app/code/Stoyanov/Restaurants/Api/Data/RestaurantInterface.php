<?php

namespace Stoyanov\Restaurants\Api\Data;

interface RestaurantInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const CAPACITY = 'capacity';
    const LOCATION = 'location';
    const CREATED_AT = 'created_at';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getCapacity();

    /**
     * @param $capacity
     * @return mixed
     */
    public function setCapacity($capacity);

    /**
     * @return mixed
     */
    public function getLocation();

    /**
     * @param $location
     * @return mixed
     */
    public function setLocation($location);
}
