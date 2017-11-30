<?php
namespace MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('MagentoEse\ThemeCustomizer\Model\Skin','MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin');
    }
}
