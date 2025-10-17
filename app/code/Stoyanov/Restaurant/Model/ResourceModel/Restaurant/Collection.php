<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model\ResourceModel\Restaurant;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Stoyanov\Restaurant\Model\Restaurant;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant as ResourceModel;

class Collection extends AbstractCollection
{
    /** @var string  Main table primary key value */
    protected $_idFieldName = 'entity_id';

    /**
     * Collection class
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Restaurant::class,
            ResourceModel::class
        );
    }
}
