<?php
namespace Stoyanov\Restaurants\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (!$setup->tableExists('restaurants')) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('restaurants')
            )
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'entity_id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Name'
                )
                ->addColumn(
                    'capacity',
                    Table::TYPE_INTEGER,
                    256,
                    ['nullable' => false],
                    'Capacity'
                )
                ->addColumn(
                    'location',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Location'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => true],
                    'Created Date'
                )
                ->setComment('restaurants Table');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
