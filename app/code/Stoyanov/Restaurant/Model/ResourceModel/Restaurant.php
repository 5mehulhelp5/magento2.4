<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Restaurant extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('restaurants', 'entity_id');
    }
}
