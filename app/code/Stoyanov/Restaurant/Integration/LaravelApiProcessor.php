<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Integration;

use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;
use Stoyanov\Restaurant\Helper\Data;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class LaravelApiProcessor extends ApiProcessor
{
    /** @var string get user register form link */
    public const string API_REGISTER_URL = "/api/register";

    /** @var string get user login form link */
    public const string API_LOGIN_URL = "/api/login";

    /** @var string get restaurant's API link */
    private const string API_RESTAURANT_URL = "/api/restaurants";

    /**
     * @param LoggerInterface $logger
     * @param CurlFactory $curlFactory
     * @param Data $data
     * @param WriterInterface $configWriter
     */
    public function __construct(
        private LoggerInterface $logger,
        private CurlFactory $curlFactory,
        private Data $data,
        private WriterInterface $configWriter
    ) {
    }

    /**
     * Create Restaurant
     *
     * @param array $data
     *
     * @return bool
     */
    public function createRestaurant(array $data): bool
    {
        try {
            $client = $this->getClient(true, $this->getApiToken());
            $client->post(
                $this->getApiUrl() . self::API_RESTAURANT_URL,
                json_encode($this->prepareRestaurantData($data))
            );
            if ($client->getStatus() === 201) {
                $this->logger->info('The new Restaurant was created!');
                return true;
            }
            return false;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        return false;
    }

    /**
     * Create Profile
     *
     * @param array $data
     *
     * @return bool
     */
    public function createProfile(array $data): bool
    {
        try {
            $client = $this->getClient(false);
            $client->post($this->getApiUrl() . self::API_REGISTER_URL, json_encode($this->prepareRegisterData($data)));
            if ($client->getStatus() === 201) {
                $this->logger->info('The new API profile was created!');
            }
            return true;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        return false;
    }

    /**
     * Get Client
     *
     * @param bool $useToken
     * @param $token
     *
     * @return Curl
     */
    public function getClient(bool $useToken, $token = null): Curl
    {
        $curl = $this->curlFactory->create();
        $curl->addHeader("content-type", "application/json");
        $curl->addHeader("Accept", "application/json");

        if ($useToken) {
            $curl->addHeader(
                "authorization",
                "Bearer " . $this->getApiToken()
            );
            return $curl;
        }
        return $curl;
    }

    /**
     * Get Api Url
     *
     * @return mixed
     */
    private function getApiUrl(): mixed
    {
        return $this->data->getConfigValue("api_URL");
    }

    /**
     * Get Api Token
     *
     * @return mixed
     */
    private function getApiToken(): mixed
    {
        return $this->data->getConfigValue("api_token");
    }

    /**
     * Prepare Register Data
     *
     * @param array $data
     *
     * @return array
     */
    private function prepareRegisterData(array $data): array
    {
        $apiData = [];
        if (!empty($data['name'])) {
            $apiData['name'] = $data['name'];
        }
        if (!empty($data['email'])) {
            $apiData['email'] = $data['email'];
        }
        if (!empty($data['password'])) {
            $apiData['password'] = $data['password'];
            $apiData['password_confirmation'] = $data['password'];
        }
        return $apiData;
    }

    /**
     * Prepare Login Data
     *
     * @param array $data
     *
     * @return array
     */
    private function prepareLoginData(array $data): array
    {
        $apiData = [];
        if (!empty($data['email'])) {
            $apiData['email'] = $data['email'];
        }
        if (!empty($data['password'])) {
            $apiData['password'] = $data['password'];
        }
        return $apiData;
    }

    /**
     * Login Profile
     *
     * @param array $data
     * @return bool
     */
    public function loginProfile(array $data): bool
    {
        try {
            $client = $this->getClient(false);
            $client->post(
                $this->getApiUrl() . self::API_LOGIN_URL,
                json_encode($this->prepareLoginData($data))
            );
            if ($client->getStatus() === 200) {
                $response = json_decode($client->getBody(), true);
                $token = $response['token'];
                $this->configWriter->save(
                    'restaurants_settings/general/api_token',
                    $token,
                    ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
                    0
                );
                return true;
            }
            return false;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        return false;
    }

    /**
     * Prepare Restaurant Data
     *
     * @param array $data
     *
     * @return array
     */
    private function prepareRestaurantData(array $data): array
    {
        $apiData = [];
        if (!empty($data['name'])) {
            $apiData['name'] = $data['name'];
        }
        if (!empty($data['location'])) {
            $apiData['location'] = $data['location'];
        }
        if (!empty($data['capacity'])) {
            $apiData['capacity'] = $data['capacity'];
        }
        return $apiData;
    }
}
