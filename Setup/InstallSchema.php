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
            'top_bar_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'top_bar_color'
        )->addColumn(
            'primary_font_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primary_font_color'
        )->addColumn(
            'primary_link_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primary_link_color'
        )->addColumn(
            'primary_link_hover_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primary_link_hover_color'
        )->addColumn(
            'primary_heading_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primary_heading_color'
        )->addColumn(
            'primary_price_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'primary_price_color'
        )->addColumn(
            'background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'background_color'
        )->addColumn(
            'category_grid_background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'category_grid_background_color'
        )->addColumn(
            'product_view_background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'product_view_background_color'
        )->addColumn(
            'block_content_background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'block_content_background_color'
        )->addColumn(
            'nav_background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'nav_background_color'
        )->addColumn(
            'nav_link_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'nav_link_color'
        )->addColumn(
            'nav_link_hover_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'nav_link_hover_color'
        )->addColumn(
            'nav_dropdown_background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'nav_dropdown_background_color'
        )->addColumn(
            'nav_dropdown_link_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'nav_dropdown_link_color'
        )->addColumn(
            'nav_dropdown_link_hover_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'nav_dropdown_link_hover_color'
        )->addColumn(
            'button_background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'button_background_color'
        )->addColumn(
            'button_link_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'button_link_color'
        )->addColumn(
            'button_link_hover_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'button_link_hover_color'
        )->addColumn(
            'button_background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [ 'nullable' => true, ],
            'button_background_color'
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
