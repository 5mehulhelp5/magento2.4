<?php

namespace Stoyanov\Restaurant\Api\Data;

use Stoyanov\Restaurant\Model\Restaurant;

interface RestaurantInterface
{
    public const string ENTITY_ID = 'entity_id';
    public const string NAME = 'name';
    public const mixed CAPACITY = 'capacity';
    public const string LOCATION = 'location';

    /**
     * Get Id
     *
     * @return mixed
     */
    public function getId(): mixed;

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return mixed
     */
    public function setId(mixed $id): Restaurant;

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function setName(string $name): Restaurant;

    /**
     * Get Capacity
     *
     * @return mixed
     */
    public function getCapacity(): mixed;

    /**
     * Set Capacity
     *
     * @param mixed $capacity
     *
     * @return Restaurant
     */
    public function setCapacity(mixed $capacity): Restaurant;

    /**
     * Get Location
     *
     * @return string
     */
    public function getLocation(): string;

    /**
     * Set Location
     *
     * @param string $location
     *
     * @return Restaurant
     */
    public function setLocation(string $location): Restaurant;
}
