<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Restaurant extends AbstractDb
{
    /** @var string  Main table name */
    public const string MAIN_TABLE = 'restaurants';

    /** @var string  Main table name primary field name */
    public const string ID_FIELD_NAME = 'entity_id';

    /**
     * Resource Model class
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
