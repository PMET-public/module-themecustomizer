<?php
namespace MagentoEse\ThemeCustomizer\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $skinTableName = 'magentoese_themecustomizer_skin';
        $elementTablename = 'magentoese_themecustomizer_elements';
        //START: install stuff
        //END:   install stuff
        
        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable($skinTableName)
        )->addColumn(
            'skin_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Name'
        )->addIndex(
            $installer->getIdxName(
                $skinTableName,
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['name'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addColumn(
            'topbarcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'topbarcolor'
        )->addColumn(
            'primaryfontcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primaryfontcolor'
        )->addColumn(
            'primarylinkcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primarylinkcolor'
        )->addColumn(
            'primarylinkhovercolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primarylinkhovercolor'
        )->addColumn(
            'navbackgroundcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'navbackgroundcolor'
        )->addColumn(
            'navlinkcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'navlinkcolor'
        )->addColumn(
            'navlinkhovercolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'navlinkhovercolor'
        )->addColumn(
            'navdropdownbackgroundcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'navdropdownbackgroundcolor'
        )->addColumn(
            'navdropdownlinkcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'navdropdownlinkcolor'
        )->addColumn(
            'navdropdownlinkhovercolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'navdropdownlinkhovercolor'
        )->addColumn(
            'primaryheadingcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primaryheadingcolor'
        )->addColumn(
            'primarypricecolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primarypricecolor'
        )->addColumn(
            'backgroundcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'backgroundcolor'
        )->addColumn(
            'categorygridbackgroundcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'categorygridbackgroundcolor'
        )->addColumn(
            'productviewbackgroundcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'productviewbackgroundcolor'
        )->addColumn(
            'blockcontentbackgroundcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'blockcontentbackgroundcolor'
        )->addColumn(
            'buttonbackgroundcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'buttonbackgroundcolor'
        )->addColumn(
            'buttonlinkcolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'buttonlinkcolor'
        )->addColumn(
            'buttonlinkhovercolor',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'buttonlinkhovercolor'
        )->addColumn(
            'additional_css',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            [ 'nullable' => true, ],
            'Additional CSS'
        )->addColumn(
            'creation_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup


        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable($elementTablename)
        )->addColumn(
            'element_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'element_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Unique Code'
        )->addIndex(
            $installer->getIdxName(
                $elementTablename,
                ['element_code'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['element_code'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addColumn(
            'frontend_label',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Front End Label'
        )->addColumn(
            'css_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            [ 'nullable' => true, ],
            'Css Code'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup
$installer->endSetup();
    }
}
