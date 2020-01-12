<?php
namespace Akhil\Shop\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (!$installer->tableExists('akhil_shop')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('akhil_shop'))
                ->addColumn(
                    'shop_id',
                    Table::TYPE_INTEGER,
                    10,
                    ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true]
                )
                ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false])
                ->addColumn('address', Table::TYPE_TEXT, '2M', ['default' => ''])
                ->addColumn('city', Table::TYPE_TEXT, 10, ['nullable' => false])
                ->addColumn('state', Table::TYPE_TEXT, 10, ['nullable' => false])
                ->addColumn('pincode', Table::TYPE_TEXT, 10, ['default' => ''])
                ->addColumn('telephone', Table::TYPE_TEXT, 10, ['default' => ''])
                ->addColumn('longitude', Table::TYPE_TEXT, 10, ['default' => ''])
                ->addColumn('latitude', Table::TYPE_TEXT, 10, ['default' => ''])
                ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
                ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
                ->setComment('table');

            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('akhil_shop_product')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('akhil_shop_product'))
                ->addColumn('shop_id', Table::TYPE_INTEGER, 10, ['nullable' => false, 'unsigned' => true])
                ->addColumn('product_id', Table::TYPE_INTEGER, 10, ['nullable' => false, 'unsigned' => true], 'Magento Product Id')
                ->addForeignKey(
                    $installer->getFkName(
                        'akhil_shop',
                        'shop_id',
                        'akhil_shop_product',
                        'shop_id'
                    ),
                    'shop_id',
                    $installer->getTable('akhil_shop'),
                    'shop_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'akhil_shop_product',
                        'shop_id',
                        'catalog_product_entity',
                        'entity_id'
                    ),
                    'product_id',
                    $installer->getTable('catalog_product_entity'),
                    'entity_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Product relation table');

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
