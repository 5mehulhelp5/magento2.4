<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Model\ResourceModel\Restaurant;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(
            \Stoyanov\Restaurants\Model\Restaurant::class,
            \Stoyanov\Restaurants\Model\ResourceModel\Restaurant::class
        );
    }
}
