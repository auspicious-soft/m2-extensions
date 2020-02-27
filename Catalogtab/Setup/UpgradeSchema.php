<?php

namespace SM\Catalogtab\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface {

    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '2.1.5', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('sm_diamond_color_size_data'),
                'diamond_data', [
                'type' => Table::TYPE_TEXT,
                'nullable' => false,
                'comment' => 'Diamond Data'
                    ]
            );
        }
        $setup->endSetup();
    }

}
