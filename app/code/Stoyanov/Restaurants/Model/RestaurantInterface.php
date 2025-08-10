<?php

namespace Stoyanov\Restaurants\Model;

interface RestaurantInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     * @return Restaurant
     */
    public function setId($id): Restaurant;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return Restaurant
     */
    public function setName(string $name): Restaurant;

    /**
     * @return int
     */
    public function getCapacity();

    /**
     * @param int $capacity
     * @return Restaurant
     */
    public function setCapacity(int $capacity): Restaurant;

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return Restaurant
     */
    public function setCreatedAt($createdAt): Restaurant;

    /**
     * @return string
     */
    public function getLocation();

    /**
     * @param string $location
     * @return Restaurant
     */
    public function setLocation($location): Restaurant;
}
