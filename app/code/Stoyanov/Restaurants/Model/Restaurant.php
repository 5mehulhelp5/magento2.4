<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Model;

use Magento\Framework\Model\AbstractModel;

class Restaurant extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Stoyanov\Restaurants\Model\ResourceModel\Restaurant::class);
    }
}
