<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Helper;

use Magento\Framework\App\Helper\{Context, AbstractHelper};

use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_RESTAURANTS = 'restaurants_settings/general/';

    public function __construct(
        private Context                       $context
    ) {
        parent::__construct($context);
    }

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_RESTAURANTS . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
