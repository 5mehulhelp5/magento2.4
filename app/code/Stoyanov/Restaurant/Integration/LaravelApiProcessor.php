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
     * @return void
     */
    public function createRestaurant()
    {
        // TODO: Implement createRestaurant() method.
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
            $client->post(
                $this->getApiUrl() . self::API_REGISTER_URL,
                    json_encode($this->prepareRegisterData($data))
            );
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
                "Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InFEQURDb2Y1TnNkWUt3MDFPY3MwWSJ9.eyJpc3MiOiJodHRwczovL2Rldi0tMDc0ZWQ3ci51cy5hdXRoMC5jb20vIiwic3ViIjoiNDlaUG5yMTZFUEdqQ0tGV0o5eG9GMEV1WFBjRmdRNk5AY2xpZW50cyIsImF1ZCI6Imh0dHA6Ly9sYXJhdmVsbG9jYWwuY29tL2FwaS9mbGlnaHRzIiwiaWF0IjoxNjQ2ODI4OTMwLCJleHAiOjE2NDY5MTUzMzAsImF6cCI6IjQ5WlBucjE2RVBHakNLRldKOXhvRjBFdVhQY0ZnUTZOIiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIn0.A_GBPHfoSzjieXHrrz-dv8b80wmbOjy11lldKhhb2f2xZmw6kUZkPG6MyAJFP9X3GrYOqqqSAH_bnX-iRSXaMvlYXTI6DnM0QPJDJY1YpAbqioI-eMH-mDchTAAkKvl1ASbOiD56tPjYCcssqqngFTxc9bNFlLgK8SiagQ1EAWNjMmoJ1WSmM5AklQ4yPo85VwzKD-_30G8aQbyJPHrDJgarbk95hsy_R8Z13Tg28n0bnUynwOeEiyL9H6OS_XZMNHtEJx-9MHg6u8EbZLQiibr4XP2717ZxOQLmzkxfi6LQN5mefEFaCS2sa-b6DdMqv4aeX4IU8VvO2bAQyOZr2g"
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
}
