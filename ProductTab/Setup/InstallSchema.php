<?php

namespace SM\ProductTab\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {


        $installer = $setup;
        $installer->startSetup();


        /**
         * Create table 'sm_productprice'
         */
        $table = $installer->getConnection()->newTable($installer->getTable('sm_productprice'))
                ->addColumn(
                        'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'ID'
                )
                
                ->addColumn(
                        'product_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'Product Id'
                )
                ->addColumn(
                        'sku', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null], 'SKU'
                )
                ->addColumn(
                        'attribute_set_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null], 'Attribute Set Name'
                )                
                ->addColumn(
                        'combination', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '2M', ['nullable' => true, 'default' => null], 'All JSON Data'
                )
                ->addColumn('default_metal', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 100, ['nullable' => true, 'default' => null], 'Default Metal'
                );                                


        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}
