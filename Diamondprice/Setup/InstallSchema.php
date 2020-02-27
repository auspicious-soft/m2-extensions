<?php

namespace SM\Diamondprice\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {


        $installer = $setup;
        $installer->startSetup();


        /**
         * Create table 'sm_diamondprice'
         */
        $table = $installer->getConnection()->newTable($installer->getTable('sm_diamondprice'))
                ->addColumn(
                        'sm_diamondprice_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Diamond Price ID'
                )
                
                ->addColumn(
                        'metal_purity_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => '1'], 'Metal Purity Id'
                ) 
                ->addColumn(
                        'combination', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null], 'Diamond Size X Diamond Shape'
                )                
                ->addColumn(
                        'price', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false, 'unsigned' => true, 'default' => '0'], 'Price'
                )                
                ->addColumn(
                        'created_time', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT], 'Creation Time'
                )
                ->addColumn(
                'update_time', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE], 'Update Time'
        );


        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}
