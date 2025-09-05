<?php

namespace Stoyanov\Restaurants\Api\Data;

interface RestaurantInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const CAPACITY = 'capacity';
    const LOCATION = 'location';
    const CREATED_AT = 'created_at';

    public function getId();

    public function setId($id);

    public function getName();

    public function setName($name);

    public function getCapacity();

    public function setCapacity($capacity);

    public function getLocation();

    public function setLocation($location);
}
