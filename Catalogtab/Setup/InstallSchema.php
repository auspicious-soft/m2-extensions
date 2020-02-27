<?php

namespace SM\Catalogtab\Setup;

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
        $table = $installer->getConnection()->newTable($installer->getTable('sm_diamond_color_size_data'))
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
                        'color_clarity_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'Color Clarity Id'
                )
                ->addColumn(
                        'diamond_shape_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'Diamond Shape Id'
                )
                ->addColumn(
                        'diamond_size_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'Diamond Size Id'
                )
                ->addColumn('weight_in_carat',\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,'12,3',['nullable' => false, 'default' => '0.0000'],'Weight In Carat'
                )                
                ->addColumn(
                        'no_of_diamond', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'No Of Diamond'
                )
                ->addColumn(
                        'diamond_setting', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'Diamond Setting'
                )
                ->addColumn(
                        'ring_size', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'Ring Size'
                )
                ->addColumn(
                        'default_diamond_color_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false], 'Default Diamond id'
                )
                ->addColumn(
                        'default_diamond_shape_size', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null], 'Default Diamond Shape Size'
                );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}
