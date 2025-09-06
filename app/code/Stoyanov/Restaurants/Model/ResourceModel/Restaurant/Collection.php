<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Model\ResourceModel\Restaurant;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Stoyanov\Restaurants\Model\Restaurant;
use Stoyanov\Restaurants\Model\ResourceModel\Restaurant as ResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            Restaurant::class,
            ResourceModel::class
        );
    }
}
