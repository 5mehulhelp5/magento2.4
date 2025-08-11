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
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'ID'
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
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'location',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Location'
                )
                ->setComment('restaurants Table');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
