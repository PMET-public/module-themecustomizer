<?php
namespace MagentoEse\ThemeCustomizer\Model\ResourceModel\Element;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('MagentoEse\ThemeCustomizer\Model\Element','MagentoEse\ThemeCustomizer\Model\ResourceModel\Element');
    }
}
