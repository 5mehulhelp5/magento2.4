<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Integration;

use Magento\Framework\HTTP\Client\Curl;

abstract class ApiProcessor
{
    /**
     * Create Restaurant
     *
     * @param array $data
     *
     * @return bool
     */
    abstract public function createRestaurant(array $data): bool;

    /**
     * Create Profile
     *
     * @param array $data
     *
     * @return bool
     */
    abstract public function createProfile(array $data): bool;

    /**
     * Get Client
     *
     * @param bool $useToken
     * @param $token
     *
     * @return Curl
     */
    abstract public function getClient(bool $useToken, $token = null): Curl;

    /**
     * Login Profile
     *
     * @param array $data
     *
     * @return bool
     */
    abstract public function loginProfile(array $data): bool;
}
