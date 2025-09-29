<?php

namespace Stoyanov\Restaurant\Api\Data;

use Stoyanov\Restaurant\Model\Restaurant;

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
    public function getId(): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function setId(mixed $id): Restaurant;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name): Restaurant;

    /**
     * @return int
     */
    public function getCapacity(): mixed;

    /**
     * @param int $capacity
     * @return Restaurant
     */
    public function setCapacity(mixed $capacity): Restaurant;

    /**
     * @return string
     */
    public function getLocation(): string;

    /**
     * @param string $location
     * @return Restaurant
     */
    public function setLocation(string $location): Restaurant;
}
