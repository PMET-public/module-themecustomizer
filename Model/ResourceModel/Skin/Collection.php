<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('MagentoEse\ThemeCustomizer\Model\Skin', 'MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin');
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['themeTable' => $this->getTable('theme')], //2nd table name by which you want to join mail table
            'main_table.applied_to = themeTable.theme_id', // common column which available in both table
            'theme_title' // '*' define that you want all column of 2nd table. if you want some particular column then you can define as ['column1','column2']
        );
    }
}
