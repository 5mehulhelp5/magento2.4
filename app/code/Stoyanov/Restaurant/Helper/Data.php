<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    public const string XML_PATH_RESTAURANTS = 'restaurants_settings/general/';

    /**
     * Get Config Value
     *
     * @param string $field
     * @param $storeId
     *
     * @return mixed
     */
    public function getConfigValue(string $field, $storeId = null): mixed
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_RESTAURANTS . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
